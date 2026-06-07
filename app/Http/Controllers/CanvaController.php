<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Design;
use App\Models\ProductTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class CanvaController extends Controller
{
    /**
     * Start the design process for a product template.
     * If the template has a Canva URL → open Canva in a new tab and show the upload page.
     * If it has fabric_json → redirect to the existing Fabric.js editor.
     */
    public function start(Request $request, ProductTemplate $productTemplate): Response|RedirectResponse
    {
        $productTemplate->load('product.subcategory.category');

        if ($productTemplate->canva_template_url) {
            return Inertia::render('Storefront/CanvaStart', [
                'template' => $this->presentTemplate($productTemplate),
                'canvaUrl' => $productTemplate->canva_template_url,
                'submitUrl' => route('canva.submit', $productTemplate),
            ]);
        }

        if ($productTemplate->fabric_json) {
            return redirect()->route('editor', ['product_template' => $productTemplate->id]);
        }

        return redirect()->route('editor');
    }

    /** Show the file-upload page for a Canva-edited design. */
    public function submitPage(ProductTemplate $productTemplate): Response
    {
        $productTemplate->load('product.subcategory.category');

        return Inertia::render('Storefront/CanvaSubmit', [
            'template' => $this->presentTemplate($productTemplate),
        ]);
    }

    /** Accept the uploaded Canva export, save as Design, add to cart. */
    public function submit(Request $request, ProductTemplate $productTemplate): RedirectResponse
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,webp|max:20480',
            'quantity' => 'nullable|integer|min:1|max:999',
        ]);

        $user = $request->user();
        $file = $request->file('file');

        $ext = $file->getClientOriginalExtension();
        $path = 'designs/' . Str::uuid() . '.' . $ext;
        Storage::disk('public')->put($path, file_get_contents($file->getRealPath()));

        $productTemplate->load('product');

        $design = Design::create([
            'user_id' => $user->id,
            'product_template_id' => $productTemplate->id,
            'name' => $productTemplate->name . ' — ' . $productTemplate->product->name,
            'fabric_json' => [],
            'preview_path' => $path,
        ]);

        CartItem::create([
            'user_id' => $user->id,
            'design_id' => $design->id,
            'product_template_id' => $productTemplate->id,
            'quantity' => $request->input('quantity', 1),
        ]);

        return redirect()->route('cart.index')
            ->with('success', 'تمت إضافة تصميمك إلى السلة بنجاح.');
    }

    private function presentTemplate(ProductTemplate $t): array
    {
        return [
            'id' => $t->id,
            'name' => $t->name,
            'preview_image' => $t->preview_image,
            'canva_template_url' => $t->canva_template_url,
            'product' => [
                'id' => $t->product->id,
                'name' => $t->product->name,
                'slug' => $t->product->slug,
                'subcategory' => $t->product->subcategory->name,
                'category' => $t->product->subcategory->category->name,
            ],
        ];
    }
}
