<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->where('is_active', true)->orderBy('coins')->get();

        return view('landing.index', compact('products'));
    }
}
