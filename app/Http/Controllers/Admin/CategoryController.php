<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Categories/Index', [
            'categories' => Category::withCount(['subcategories'])
                ->with(['subcategories' => fn ($q) => $q->withCount('products')->orderBy('sort_order')])
                ->orderBy('sort_order')
                ->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:10',
            'description' => 'nullable|string|max:500',
        ]);

        Category::create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . '-' . Str::random(4),
            'icon' => $data['icon'] ?? '📦',
            'description' => $data['description'] ?? null,
            'sort_order' => Category::max('sort_order') + 1,
        ]);

        return back()->with('success', 'تمت إضافة التصنيف.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:10',
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $category->update($data);

        return back()->with('success', 'تم تحديث التصنيف.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return back()->with('success', 'تم حذف التصنيف.');
    }
}
