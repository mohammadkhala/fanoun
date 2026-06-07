<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Users/Index', [
            'admins' => User::where('account_type', 'admin')
                ->orderBy('name')
                ->get(['id', 'name', 'email', 'phone', 'created_at'])
                ->map(fn ($u) => [
                    'id' => $u->id,
                    'name' => $u->name,
                    'email' => $u->email,
                    'phone' => $u->phone,
                    'created_at' => $u->created_at->format('Y-m-d'),
                ]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'phone' => 'nullable|string|max:30',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'account_type' => 'admin',
        ]);

        return back()->with('success', 'تم إنشاء حساب المدير.');
    }

    public function destroy(Request $request, User $user)
    {
        abort_unless($user->isAdmin(), 404);
        abort_if($user->id === $request->user()->id, 403, 'لا يمكنك حذف حسابك الحالي.');

        $user->delete();

        return back()->with('success', 'تم حذف المدير.');
    }
}
