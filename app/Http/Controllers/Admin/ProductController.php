<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Products;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();


        return view('admin.products.index', ['products' => $products]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        $data = $request->only([
            'name',
            'content',
            'quantity',
            'price',
            'category_id',
        ]);


        $data['user_id'] = auth()->id();


        try {
            $product = Products::create($data);
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->withInput($data)->with('status', 'Create failed!');
        }
        return redirect('/admin/products')->with('status', 'Create success!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::find($id);
        $data = ['product' => $product];
        //$data = compact('product');
        //dd($product);
        return view('products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = Products::findOrFail($id);
        $data = ['product' => $product];
        return view('admin.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //
        $data = $request->only([
            'name',
            'content',
            'quantity',
            'price',
        ]);

        $product = Products::findOrFail($id);

        try {
            $product->update($data);
        } catch (\Exception $e) {
            return back()->withInput($data)->with('status', 'Update failed!');
        }
        return redirect('admin/products')->with('status', 'Update success!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Products::findOrFail($id);
        try {
            $product->delete();
        } catch (\Exception $e) {
            return back()->with($data)->with('status', 'Delete failed!');
        }
        return redirect('admin/products')->with('status', 'Delete success!'); 

    }
}
