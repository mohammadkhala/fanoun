<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReportController extends Controller
{
    /** تقارير المبيعات */
    public function sales()
    {
        $paid = fn ($q) => $q->where('status', '!=', 'cancelled');

        // آخر 12 شهر
        $months = collect(range(11, 0))->map(function ($i) {
            $d = now()->subMonths($i);

            return [
                'key' => $d->format('Y-m'),
                'label' => $d->translatedFormat('M Y'),
                'count' => Order::whereYear('created_at', $d->year)
                    ->whereMonth('created_at', $d->month)
                    ->where('status', '!=', 'cancelled')->count(),
                'total' => (float) Order::whereYear('created_at', $d->year)
                    ->whereMonth('created_at', $d->month)
                    ->where('status', '!=', 'cancelled')->sum('total'),
            ];
        });

        $statusCounts = [];
        foreach (Order::STATUSES as $key => $label) {
            $statusCounts[] = ['key' => $key, 'label' => $label, 'count' => Order::where('status', $key)->count()];
        }

        return Inertia::render('Admin/Reports/Sales', [
            'kpis' => [
                'orders' => Order::count(),
                'revenue' => (float) Order::where('status', '!=', 'cancelled')->sum('total'),
                'avg' => round((float) Order::where('status', '!=', 'cancelled')->avg('total') ?? 0, 2),
                'this_month' => (float) Order::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month)
                    ->where('status', '!=', 'cancelled')->sum('total'),
            ],
            'months' => $months,
            'statusCounts' => $statusCounts,
            'topCustomers' => Order::select('user_id', DB::raw('SUM(total) as spent'), DB::raw('COUNT(*) as orders'))
                ->where('status', '!=', 'cancelled')
                ->groupBy('user_id')->orderByDesc('spent')->limit(8)->get()
                ->map(fn ($r) => [
                    'name' => User::find($r->user_id)?->name ?? '—',
                    'orders' => (int) $r->orders,
                    'spent' => (float) $r->spent,
                ]),
        ]);
    }

    /** التقارير المالية */
    public function financial()
    {
        $gross = (float) Order::where('status', '!=', 'cancelled')->sum('total');
        $cancelled = (float) Order::where('status', 'cancelled')->sum('total');
        $delivered = (float) Order::where('status', 'delivered')->sum('total');
        $pending = (float) Order::whereIn('status', ['pending_review', 'approved', 'in_production', 'ready'])->sum('total');

        $tier = [
            'retail' => (float) Order::where('pricing_tier', 'retail')->where('status', '!=', 'cancelled')->sum('total'),
            'wholesale' => (float) Order::where('pricing_tier', 'wholesale')->where('status', '!=', 'cancelled')->sum('total'),
        ];

        return Inertia::render('Admin/Reports/Financial', [
            'kpis' => [
                'gross' => $gross,
                'delivered' => $delivered,
                'pending' => $pending,
                'cancelled' => $cancelled,
            ],
            'tier' => $tier,
            'recent' => Order::with('user')->latest()->limit(12)->get()->map(fn ($o) => [
                'reference' => $o->reference,
                'customer' => $o->user?->name,
                'total' => (float) $o->total,
                'status' => $o->statusLabel(),
                'date' => $o->created_at->format('Y-m-d'),
            ]),
        ]);
    }

    /** الزوار والإحصائيات */
    public function visitors()
    {
        $days = collect(range(13, 0))->map(function ($i) {
            $d = now()->subDays($i);

            return [
                'label' => $d->format('m-d'),
                'count' => Visit::whereDate('visited_on', $d->toDateString())->count(),
            ];
        });

        $topPages = Visit::select('url', DB::raw('COUNT(*) as hits'))
            ->groupBy('url')->orderByDesc('hits')->limit(10)->get()
            ->map(fn ($r) => ['url' => $r->url === '' ? '/' : $r->url, 'hits' => (int) $r->hits]);

        return Inertia::render('Admin/Reports/Visitors', [
            'kpis' => [
                'total' => Visit::count(),
                'today' => Visit::whereDate('visited_on', now()->toDateString())->count(),
                'week' => Visit::where('visited_on', '>=', now()->subDays(7)->toDateString())->count(),
                'unique_ips' => Visit::distinct('ip')->count('ip'),
            ],
            'days' => $days,
            'topPages' => $topPages,
        ]);
    }
}
