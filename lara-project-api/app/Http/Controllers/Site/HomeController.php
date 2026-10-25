<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $mobiles        = $this->latestProduct(1);
        $watches        = $this->latestProduct(2);
        $cameras        = $this->latestProduct(3);
        $accessories    = $this->latestProduct(4);
        $speakers       = $this->latestProduct(5);
        return view('site.pages.home', compact('mobiles','watches','cameras','accessories','speakers'));
    }

    public function latestProduct($_category_id)
    {
        $products = Product::select('id', 'name', 'price', 'image', 'quantity')
                    ->where('category_id', $_category_id)
                    ->where('active', 1)
                    ->orderBy('id', 'desc')
                    ->limit(5)
                    ->get();
        return $products;
    }

    public function details($id)
    {
        $product = Product::findOrFail($id);
        // return view('site.pages.product-details', ['item' => $product]);
        return view('site.pages.product-details', compact('product'));
    }

    public function cart()
    {
        return view('site.pages.cart');
    }
}
