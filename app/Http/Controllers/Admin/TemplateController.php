<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class TemplateController extends Controller
{
    public const CATEGORIES = [
        'corporate' => 'تكريم ومؤسسات',
        'sports' => 'رياضة وبطولات',
        'academic' => 'أكاديمي وتخرّج',
        'occasion' => 'مناسبات',
    ];

    public function index(): Response
    {
        return Inertia::render('Admin/Templates/Index', [
            'templates' => Template::orderBy('sort_order')->get()
                ->map(fn (Template $t) => [
                    'id' => $t->id,
                    'name' => $t->name,
                    'category' => $t->category,
                    'category_label' => self::CATEGORIES[$t->category] ?? $t->category,
                    'preview_image' => $t->preview_image,
                    'retail_price' => (float) $t->retail_price,
                    'wholesale_price' => (float) $t->wholesale_price,
                    'badge' => $t->badge,
                    'is_active' => (bool) $t->is_active,
                    'designs_count' => $t->designs()->count(),
                ]),
            'categories' => self::CATEGORIES,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Templates/Form', [
            'template' => null,
            'categories' => self::CATEGORIES,
        ]);
    }

    public function edit(Template $template): Response
    {
        return Inertia::render('Admin/Templates/Form', [
            'template' => [
                'id' => $template->id,
                'name' => $template->name,
                'description' => $template->description,
                'category' => $template->category,
                'preview_image' => $template->preview_image,
                'retail_price' => (float) $template->retail_price,
                'wholesale_price' => (float) $template->wholesale_price,
                'badge' => $template->badge,
                'sort_order' => $template->sort_order,
                'is_active' => (bool) $template->is_active,
            ],
            'categories' => self::CATEGORIES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request, null);
        $data['slug'] = $this->uniqueSlug($data['name']);

        if ($request->hasFile('image')) {
            $data['preview_image'] = $this->storeImage($request);
        }
        unset($data['image']);

        Template::create($data);

        return redirect()->route('admin.templates.index')->with('success', 'تمت إضافة القالب.');
    }

    public function update(Request $request, Template $template): RedirectResponse
    {
        $data = $this->validateData($request, $template->id);

        if ($request->hasFile('image')) {
            $data['preview_image'] = $this->storeImage($request);
        }
        unset($data['image']);

        $template->update($data);

        return redirect()->route('admin.templates.index')->with('success', 'تم تحديث القالب.');
    }

    public function toggle(Template $template): RedirectResponse
    {
        $template->update(['is_active' => ! $template->is_active]);

        return back()->with('success', $template->is_active ? 'تم تفعيل القالب.' : 'تم إخفاء القالب.');
    }

    public function destroy(Template $template): RedirectResponse
    {
        $template->delete();

        return back()->with('success', 'تم حذف القالب.');
    }

    private function validateData(Request $request, ?int $id): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|string|in:' . implode(',', array_keys(self::CATEGORIES)),
            'retail_price' => 'required|numeric|min:0',
            'wholesale_price' => 'required|numeric|min:0',
            'badge' => 'nullable|string|max:40',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
            'image' => ($id ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'template';
        $slug = $base;
        $i = 1;
        while (Template::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    private function storeImage(Request $request): string
    {
        // Store in public/templates so existing front-end paths (/templates/x.png) keep working.
        $file = $request->file('image');
        $name = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('templates'), $name);

        return 'templates/' . $name;
    }
}
