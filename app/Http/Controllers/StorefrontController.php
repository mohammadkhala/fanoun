<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function home()
    {
        return view('storefront.home');
    }

    public function products(Request $request)
    {
        return view('storefront.products');
    }

    public function product($id)
    {
        return view('storefront.product', ['productId' => $id]);
    }

    public function contact()
    {
        return view('storefront.contact');
    }

    public function offers()
    {
        return view('storefront.offers');
    }

    public function account()
    {
        return view('storefront.account');
    }

    public function loginPage()
    {
        return view('storefront.login');
    }

    public function registerPage()
    {
        return view('storefront.register');
    }

    public function orderTrack()
    {
        return view('storefront.order-track');
    }

    public function privacy()
    {
        return view('storefront.policy', ['type' => 'privacy']);
    }

    public function terms()
    {
        return view('storefront.policy', ['type' => 'terms']);
    }

    public function checkout()
    {
        return view('storefront.checkout');
    }

    /**
     * محرر التصميم المبني على Fabric.js
     * يمكن استدعاؤه مع معرّف المنتج اختيارياً: /storefront/design?product=5
     */
    public function designEditor(Request $request)
    {
        return view('storefront.design-editor', [
            'productId' => $request->query('product'),
        ]);
    }
}
