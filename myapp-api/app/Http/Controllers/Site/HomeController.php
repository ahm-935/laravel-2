<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $mobiles = $this->latestProducts(1);

        $watches = $this->latestProducts(2);

        $cameras = $this->latestProducts(3);

        $accessories = $this->latestProducts(4);

        $speakers = $this->latestProducts(5);
        return view('site.pages.home', compact('mobiles', 'watches', 'cameras', 'accessories', 'speakers'));
    }

    public function latestProducts($_category_id){

        $products = Product::select('id', 'name', 'price', 'image','quantity')
        ->where('category_id', $_category_id)
        ->where('active', 1)
        ->orderBy('id', 'desc')
        ->limit(5)
        ->get();
        return $products;
    }
    public function details($id){
        $product = Product::findOrFail($id);
        return view('site.pages.product-details', compact('product'));
    }   

    public function cart(){
        return view('site.pages.cart');
    }
}
