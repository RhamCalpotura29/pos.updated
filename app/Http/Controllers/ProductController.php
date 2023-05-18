<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::latest()->paginate(5);

        return view('products.index', compact('products'))->with(request()->input('page'));

        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Product::create($request->all());
        return redirect()->back()->with('success','Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function psearch(Request $request, Product $product )
     {
         $psearch = $request->input('search');
         $products = Product::query()
        ->where('product_name', 'LIKE', "%{$psearch}%")
        ->orWhere('price', 'LIKE', "%{$psearch}%")
        ->orWhere('alert_stock', 'LIKE', "%{$psearch}%")
        ->orWhere('quantity', 'LIKE', "%{$psearch}%")
        ->orWhere('description', 'LIKE', "%{$psearch}%")
        ->orWhere('brand', 'LIKE', "%{$psearch}%")
        ->paginate(5);
        
        return view('products.index', compact('products'));
     }

    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all()); 

        return redirect()->back()->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete(); 

        return redirect()->back()->with('success', 'Product Deleted Successfully');
    }


}
