<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();
        $items = $this->items($user);

        return Inertia::render('Cart/Index', [
            'items' => $items,
            'subtotal' => $items->sum('line_total'),
            'tier' => $user->pricingTier(),
        ]);
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->user_id === $request->user()->id, 403);

        $data = $request->validate(['quantity' => 'required|integer|min:1|max:999']);
        $cartItem->update(['quantity' => $data['quantity']]);

        return back();
    }

    public function destroy(Request $request, CartItem $cartItem): RedirectResponse
    {
        abort_unless($cartItem->user_id === $request->user()->id, 403);

        $cartItem->delete();

        return back()->with('success', 'تمت إزالة العنصر من السلة.');
    }

    /** @return \Illuminate\Support\Collection */
    public static function items($user)
    {
        return CartItem::with(['design', 'template'])
            ->where('user_id', $user->id)
            ->latest()
            ->get()
            ->map(function (CartItem $item) use ($user) {
                $price = $item->template ? $item->template->priceFor($user) : 0;

                return [
                    'id' => $item->id,
                    'title' => $item->template?->name ?? $item->design?->name ?? 'تصميم مخصّص',
                    'preview' => $item->design?->preview_path,
                    'design_id' => $item->design_id,
                    'template_id' => $item->template_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $price,
                    'line_total' => $price * $item->quantity,
                ];
            });
    }
}
