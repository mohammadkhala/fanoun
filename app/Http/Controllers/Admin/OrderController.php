<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class OrderController extends Controller
{
    public function index(Request $request): Response
    {
        $status = $request->query('status');

        $query = Order::with('user')->latest();
        if ($status) {
            $query->where('status', $status);
        }

        return Inertia::render('Admin/Orders/Index', [
            'orders' => $query->get()->map(fn (Order $o) => [
                'id' => $o->id,
                'reference' => $o->reference,
                'customer' => $o->user?->name,
                'phone' => $o->contact_phone,
                'status' => $o->status,
                'status_label' => $o->statusLabel(),
                'total' => (float) $o->total,
                'tier' => $o->pricing_tier,
                'created_at' => $o->created_at->format('Y-m-d'),
            ]),
            'statuses' => Order::STATUSES,
            'filter' => $status,
        ]);
    }

    public function show(Order $order): Response
    {
        $order->load(['items.design.productTemplate.product', 'user']);

        return Inertia::render('Admin/Orders/Show', [
            'order' => [
                'id'           => $order->id,
                'reference'    => $order->reference,
                'status'       => $order->status,
                'status_label' => $order->statusLabel(),
                'tier'         => $order->pricing_tier,
                'subtotal'     => (float) $order->subtotal,
                'total'        => (float) $order->total,
                'contact_name' => $order->contact_name,
                'contact_phone'=> $order->contact_phone,
                'notes'        => $order->notes,
                'admin_notes'  => $order->admin_notes,
                'customer'     => $order->user?->name,
                'created_at'   => $order->created_at->format('Y-m-d H:i'),
                'items'        => $order->items->map(fn (OrderItem $i) => [
                    'title'       => $i->title,
                    'preview'     => $i->preview_path,
                    'design_id'   => $i->design_id,
                    'quantity'    => $i->quantity,
                    'unit_price'  => (float) $i->unit_price,
                    'line_total'  => (float) $i->line_total,
                    // for promote-to-template feature
                    'can_promote' => $i->design && $i->design->product_template_id,
                    'product_name'=> $i->design?->productTemplate?->product?->name,
                    'templates_count' => $i->design?->productTemplate?->product?->templates()->count(),
                ]),
            ],
            'statuses' => Order::STATUSES,
        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(Order::STATUSES))],
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $order->update($data);

        return back()->with('success', 'تم تحديث حالة الطلب.');
    }
}
