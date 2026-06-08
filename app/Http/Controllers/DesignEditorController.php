<?php

namespace App\Http\Controllers;

use App\Models\ProductTemplate;
use Inertia\Inertia;
use Inertia\Response;

class DesignEditorController extends Controller
{
    public function show(ProductTemplate $productTemplate): Response
    {
        abort_if(! $productTemplate->is_active, 404);

        $productTemplate->load('product.subcategory.category');

        return Inertia::render('Storefront/DesignEditor', [
            'template' => [
                'id'            => $productTemplate->id,
                'name'          => $productTemplate->name,
                'preview_image' => $productTemplate->preview_image,
                'product'       => [
                    'name'        => $productTemplate->product->name,
                    'slug'        => $productTemplate->product->slug,
                    'subcategory' => $productTemplate->product->subcategory->name,
                    'category'    => $productTemplate->product->subcategory->category->name,
                ],
            ],
            // Get key from .env  POLOTNO_KEY=your_key
            // Free dev key available at https://polotno.dev
            'polotnoKey' => config('services.polotno.key', 'nFt5StABaKom'),
        ]);
    }
}
