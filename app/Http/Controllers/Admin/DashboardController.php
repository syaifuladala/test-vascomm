<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $productLatest = Product::latest()->take(3)->get();
            $product = Product::count();
            $userActive = User::where('active', true)->count();
            $users = User::count();
            return view('vendor.backpack.base.dashboard', [
                'dashboard' => [
                    [
                        'name' => 'Jumlah User',
                        'count' => $users,
                        'unit' => 'User'
                    ],
                    [
                        'name' => 'Jumlah User Aktif',
                        'count' => $userActive,
                        'unit' => 'User'
                    ],
                    [
                        'name' => 'Jumlah Produk',
                        'count' => $product,
                        'unit' => 'Produk'
                    ],
                ],
                'products' => $productLatest
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
