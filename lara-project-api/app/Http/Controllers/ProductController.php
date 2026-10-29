<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Services\UploadImgService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $products = Product::from('products p')
        //                     ->join('categories c', 'c.id', '=', 'p.category_id')
        //                     ->join('brands c', 'c.id', '=', 'p.brand_id')
        //                     ->select('p.*', 'c.name as category', 'b.name as brand')
        //                     ->get();

        // if($request->search && $request->category_id && $request->brand_id) {
        //     dd($request->search . " " . $request->category_id . " " . $request->brand_id);
        // }

        $query = Product::query();
        if ($request->search) {
            // $query->where('name', 'like', "%{$request->search}%");
            $query->where('name', 'like', "%" . $request->search . "%");
        }
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->brand_id) {
            $query->where('brand_id', $request->brand_id);
        }
        $products = $query->with('category', 'brand')
            ->orderby('id', 'desc')
            ->paginate();

        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => true,
                'products' => $products,
            ]);
        }

        $categories = Category::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();
        // $products = Product::with('category', 'brand')
        //     ->orderby('id', 'desc')
        //     ->paginate();
        // dd($products->first()->category->name);
        return view('admin.pages.product.index', compact('products', 'categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            $categories = Category::orderBy('name', 'asc')->get();
            $brands = Brand::orderBy('name', 'asc')->get();
            return response()->json([
                'success' => true,
                'categories' => $categories,
                'brands' => $brands,
            ]);
        }

        $categories = Category::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();
        return view('admin.pages.product.create', [
            'categories'    => $categories,
            'brands'        => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // if ($request->hasFile('image')) {
        //     return response()->json("Image Found");
        // } else {
        //     return response()->json("Image Not Found");
        // }

        if ($request->wantsJson() || $request->is('api/*')) {
            $request->validate(
                [
                    'name' => 'required|min:3',
                    'price' => 'required|numeric',
                    'quantity' => 'required|integer',
                    'reorder_level' => 'required|integer',
                    'category_id' => 'required|exists:categories,id',
                    'brand_id' => 'required|exists:brands,id',
                    'description' => 'required',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:500',
                ]
            );

            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity ?? $request->qty,
                'reorder_level' => $request->reorder_level ?? $request->reorder,
                'description' => $request->description ?? $request->desc,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'active' => $request->has('active') ? ($request->active ? 1 : 0) : 1,
            ];

            if ($request->hasFile('image')) {
                $data['image'] = UploadImgService::upload($request->image, 'uploads/products');
            }

            $product = Product::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
                'product' => $product->load('category', 'brand'),
            ], 201);
        }

        // dd($request->all());
        $request->validate(
            [
                // For multiple image
                //    'image'  => 'required|array',
                //    'image*' => 'images|mimes:jpeg,png,jpg,gif,svg|max:2048',

                'name' => 'required|min:3',
                // For single image
                'image' => 'image|mimes:jpeg,png,jpg|max:500',
            ],
            [
                'name.min' => 'Please enter at least 3 characters',
                'image.max' => 'Sorry! Image size is too large. Maximum size is 500kb.',
            ]
        );
        // dd($request->active);

        if ($request->hasFile('image')) {
            // dd("Image Found");
            // $imgName = time() . '.' . $request->image->extension();
            // $imgName = time() . '.' . $request->image->getClientOriginalExtension();
            // // dd($request->image->getClientOriginalExtension());
            // $request->image->move(public_path('uploads'), $imgName);

            $imgName = UploadImgService::upload($request->image, 'uploads/products');

            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->qty,
                'reorder_level' => $request->reorder,
                'description' => $request->desc,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'active' => $request->active ? 1 : 0,
                // 'image'         => "uploads/" . $imgName,
                'image' => $imgName,
            ]);
            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } else {
            // dd("No Image");
            // Product::create($request->all());
            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->qty,
                'reorder_level' => $request->reorder,
                'description' => $request->desc,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'active' => $request->active ? 1 : 0,
            ]);
            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Product $product)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            $product->load('category', 'brand');
            return response()->json([
                'success' => true,
                'product' => $product,
            ]);
        }

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            $request->validate([
                'name' => 'required|min:3',
                'price' => 'required|numeric',
                'quantity' => 'required|integer',
                'reorder_level' => 'required|integer',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'description' => 'required',
            ]);

            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity ?? $request->qty,
                'reorder_level' => $request->reorder_level ?? $request->reorder,
                'description' => $request->description ?? $request->desc,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'active' => $request->has('active') ? ($request->active ? 1 : 0) : $product->active,
            ];

            if ($request->hasFile('image')) {
                if ($product->image && file_exists(public_path($product->image))) {
                    @unlink(public_path($product->image));
                }
                $data['image'] = UploadImgService::upload($request->image, 'uploads/products');
            }

            $product->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'product' => $product->fresh(['category', 'brand']),
            ]);
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        if ($request->wantsJson() || $request->is('api/*')) {
            if ($product->image && file_exists(public_path($product->image))) {
                @unlink(public_path($product->image));
            }
            $product->delete();
            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully',
            ]);
        }

        // dd($product);
        if ($product->image) {
            @unlink(public_path($product->image));
        }
        Product::destroy($product->id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
