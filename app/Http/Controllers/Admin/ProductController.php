<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Models\ProductTemplate;
use App\Models\Subcategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Products/Index', [
            'products' => Product::with(['subcategory.category'])
                ->withCount('templates')
                ->orderBy('sort_order')
                ->get()
                ->map(fn (Product $p) => [
                    'id'              => $p->id,
                    'name'            => $p->name,
                    'slug'            => $p->slug,
                    'subcategory'     => $p->subcategory->name,
                    'subcategory_id'  => $p->subcategory_id,
                    'category'        => $p->subcategory->category->name,
                    'category_id'     => $p->subcategory->category_id,
                    'retail_price'    => (float) $p->retail_price,
                    'wholesale_price' => (float) $p->wholesale_price,
                    'badge'           => $p->badge,
                    'cover_image'     => $p->cover_image,
                    'sizes'           => $p->sizes ?? [],
                    'templates_count' => $p->templates_count,
                    'is_active'       => (bool) $p->is_active,
                ]),
            'subcategories' => Subcategory::with('category')->orderBy('category_id')->orderBy('sort_order')
                ->get()
                ->map(fn ($s) => ['id' => $s->id, 'name' => $s->name, 'category' => $s->category->name, 'category_id' => $s->category_id]),
            'categories' => Category::where('is_active', true)->orderBy('sort_order')
                ->get(['id', 'name']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'subcategory_id'  => 'required|exists:subcategories,id',
            'name'            => 'required|string|max:150',
            'description'     => 'nullable|string|max:1000',
            'retail_price'    => 'required|numeric|min:0',
            'wholesale_price' => 'required|numeric|min:0',
            'badge'           => 'nullable|string|max:30',
            'cover_image'     => 'nullable|image|max:4096',
            'sizes'           => 'nullable|array',
            'sizes.*'         => 'string|max:50',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('products', 'public');
        }

        Product::create([
            ...$data,
            'cover_image' => $coverPath,
            'slug'        => Str::slug($data['name']) . '-' . Str::random(4),
            'sort_order'  => Product::max('sort_order') + 1,
        ]);

        return back()->with('success', 'تمت إضافة المنتج.');
    }

    public function edit(Product $product): Response
    {
        return Inertia::render('Admin/Products/Edit', [
            'product' => [
                'id'              => $product->id,
                'name'            => $product->name,
                'description'     => $product->description,
                'subcategory_id'  => $product->subcategory_id,
                'retail_price'    => (float) $product->retail_price,
                'wholesale_price' => (float) $product->wholesale_price,
                'badge'           => $product->badge,
                'cover_image'     => $product->cover_image,
                'sizes'           => $product->sizes ?? [],
                'is_active'       => (bool) $product->is_active,
                'templates'       => $product->templates()->get()->map(fn (ProductTemplate $t) => [
                    'id'                 => $t->id,
                    'name'               => $t->name,
                    'preview_image'      => $t->preview_image,
                    'canva_template_url' => $t->canva_template_url,
                    'sort_order'         => $t->sort_order,
                    'is_active'          => (bool) $t->is_active,
                ]),
            ],
            'subcategories' => Subcategory::with('category')->orderBy('category_id')->orderBy('sort_order')
                ->get()
                ->map(fn ($s) => ['id' => $s->id, 'name' => $s->name, 'category' => $s->category->name, 'category_id' => $s->category_id]),
            'categories' => Category::where('is_active', true)->orderBy('sort_order')
                ->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'subcategory_id'  => 'required|exists:subcategories,id',
            'name'            => 'required|string|max:150',
            'description'     => 'nullable|string|max:1000',
            'retail_price'    => 'required|numeric|min:0',
            'wholesale_price' => 'required|numeric|min:0',
            'badge'           => 'nullable|string|max:30',
            'is_active'       => 'boolean',
            'cover_image'     => 'nullable|image|max:4096',
            'sizes'           => 'nullable|array',
            'sizes.*'         => 'string|max:50',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($product->cover_image) {
                Storage::disk('public')->delete($product->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('products', 'public');
        } else {
            unset($data['cover_image']); // don't overwrite with null
        }

        $product->update($data);

        return back()->with('success', 'تم تحديث المنتج.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return back()->with('success', 'تم حذف المنتج.');
    }

    public function storeTemplate(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'preview_image' => 'nullable|image|max:4096',
            'canva_template_url' => 'nullable|url|max:500',
        ]);

        if ($product->templates()->count() >= 3) {
            return back()->withErrors(['name' => 'لا يمكن إضافة أكثر من 3 قوالب لكل منتج.']);
        }

        $path = null;
        if ($request->hasFile('preview_image')) {
            $path = $request->file('preview_image')->store('product-templates', 'public');
        }

        $product->templates()->create([
            'name' => $data['name'],
            'preview_image' => $path,
            'canva_template_url' => $data['canva_template_url'] ?? null,
            'sort_order' => $product->templates()->max('sort_order') + 1,
        ]);

        return back()->with('success', 'تمت إضافة القالب.');
    }

    public function updateTemplate(Request $request, ProductTemplate $template): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'preview_image' => 'nullable|image|max:4096',
            'canva_template_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('preview_image')) {
            if ($template->preview_image) {
                Storage::disk('public')->delete($template->preview_image);
            }
            $data['preview_image'] = $request->file('preview_image')->store('product-templates', 'public');
        }

        $template->update($data);

        return back()->with('success', 'تم تحديث القالب.');
    }

    public function destroyTemplate(ProductTemplate $template): RedirectResponse
    {
        if ($template->preview_image) {
            Storage::disk('public')->delete($template->preview_image);
        }
        $template->delete();

        return back()->with('success', 'تم حذف القالب.');
    }
}
