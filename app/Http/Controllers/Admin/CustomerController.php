<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class CustomerController extends Controller
{
    public function index(Request $request): Response
    {
        $type = $request->query('type');     // individual | company
        $search = trim((string) $request->query('q', ''));

        $query = User::where('account_type', '!=', 'admin')
            ->withCount('orders')
            ->with('companyProfile')
            ->latest();

        if ($type) {
            $query->where('account_type', $type);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        return Inertia::render('Admin/Customers/Index', [
            'customers' => $query->get()->map(fn (User $u) => [
                'id'                 => $u->id,
                'name'               => $u->name,
                'email'              => $u->email,
                'phone'              => $u->phone,
                'account_type'       => $u->account_type,
                'company_status'     => $u->company_status,
                'company_name'       => $u->companyProfile?->company_name,
                'trade_license_no'   => $u->companyProfile?->trade_license_no,
                'trade_license_path' => $u->companyProfile?->trade_license_path,
                'company_city'       => $u->companyProfile?->city,
                'review_notes'       => $u->companyProfile?->review_notes,
                'orders_count'       => $u->orders_count,
                'created_at'         => $u->created_at->format('Y-m-d'),
            ]),
            'filters' => ['type' => $type, 'q' => $search],
            'counts' => [
                'all' => User::where('account_type', '!=', 'admin')->count(),
                'individual' => User::where('account_type', 'individual')->count(),
                'company' => User::where('account_type', 'company')->count(),
            ],
        ]);
    }

    /** Admin can adjust a customer's company approval status. */
    public function update(Request $request, User $customer): RedirectResponse
    {
        abort_if($customer->isAdmin(), 403);

        $data = $request->validate([
            'company_status' => ['nullable', Rule::in(['pending', 'approved', 'rejected'])],
        ]);

        $customer->update(['company_status' => $data['company_status'] ?? null]);
        $customer->companyProfile?->update(['status' => $data['company_status'] ?? 'pending']);

        return back()->with('success', 'تم تحديث حالة العميل.');
    }
}
