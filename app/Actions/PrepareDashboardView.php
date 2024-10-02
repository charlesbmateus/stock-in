<?php

namespace App\Actions;

use App\Models\Product;

class PrepareDashboardView
{
    public function handle()
    {
        $products = Product::all();
        $totalStock = Product::sum('stock');

        return view('dashboard', ['products' => $products, 'totalStock' => $totalStock]);
    }
}
