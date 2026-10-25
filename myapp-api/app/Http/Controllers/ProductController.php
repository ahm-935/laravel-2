<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$products = Product::from('products as p')      
        // ->join('categories as c', 'p.category_id', '=', 'c.id')
        // ->join('brands as b', 'p.brand_id', '=', 'b.id')
        // ->select('p.*', 'c.name as category_name' , 'b.name as brand_name')
        //->get();
        // $products = Product::with('brand')
        // ->orderBy('id', 'desc')
        // ->get();
        // // dd($products);
        // return view('admin.pages.product.index', compact('products'));
        // if($request->search && $request->category && $request->brand){
        //     dd($request->search ." ". $request->category ." ". $request->brand);
        // }
        $query = Product::query();
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
        if ($request->brand) {
            $query->where('brand_id', $request->brand);
        }
        $products = $query->with('category', 'brand')
            ->orderBy('id', 'desc')
            ->paginate();

        $categories = Category::all();
        $brands = Brand::all();
        // $products = Product::with('category')
        //     ->orderBy('id', 'desc')
        //     ->paginate();
        // dd($products);
        return view('admin.pages.product.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('admin.pages.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:3',
            // 'image' => 'required|array',
            // 'image*' => 'image|mimes:jpeg,png,jpg|max:2048|min:10',
            'image' => 'mimes:png,jpg,jpeg,svg,webp|max:500',
        ], [
            'name.min' => 'Minimum 3 characters required',
            'image.mimes' => 'Image type should be png,jpg,jpeg,svg',
            'image.max' => 'Oops! Too large file. Image size should be less than 500KB',
        ]);
        if ($request->hasFile('image')) {
            // dd('Image uploaded');
            // dd($imgName =  time().'.'. $request->image->extension());
            // dd($imgName =  time().'.'. $request->image->getClientOriginalExtension());
            $imgName =  time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imgName);

            Product::create([
                'name'          => $request->name,
                'price'         => $request->price,
                'quantity'      => $request->quantity,
                'reorder_level' => $request->reorder_level,
                'description'   => $request->description,
                'category_id'   => $request->category_id,
                'brand_id'      => $request->brand_id,
                'active'        => $request->active ? 1 : 0,
                'image'         =>  'uploads/' . $imgName
            ]);
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        } else {
            // dd('Image not uploaded');
            Product::create([
                'name'          => $request->name,
                'price'         => $request->price,
                'quantity'      => $request->quantity,
                'reorder_level' => $request->reorder_level,
                'description'   => $request->description,
                'category_id'   => $request->category_id,
                'brand_id'      => $request->brand_id,
                'active'        => $request->active ? 1 : 0,
            ]);
            return redirect()->route('products.index')->with('success', 'Product created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.pages.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('admin.pages.product.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name'       => 'required|string|max:255',
        'category_id'=> 'required|exists:categories,id',
        'brand_id'   => 'required|exists:brands,id',
        'price'      => 'required|numeric|min:0',
        'quantity'   => 'required|integer|min:0',
        'active'     => 'required|boolean',
        'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // এখানে আপনার existing image upload/delete logic রাখবেন
    }

    $product->update($validated);

    return redirect()
        ->route('products.index')
        ->with('success', 'Product updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
