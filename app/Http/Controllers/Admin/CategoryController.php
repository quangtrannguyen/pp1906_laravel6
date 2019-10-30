<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $categories = Category::orderBy('created_at', 'desc')->get();


        return view('admin.categories.index', ['category' => $category]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        
        //
        $data = $request->only([
            'name',
            'parent_id',
        ]);

        $data['user_id'] = auth()->id();
        
        try {
            $category = Category::create($data);
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->withInput($data)->with('status', 'Create failed!');
        }
        return redirect('/admin/categories')->with('status', 'Create success!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        $data = ['category' => $category];
        //$data = compact('product');
        //dd($product);
        return view('categories.show', $data);
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
        $category = Category::findOrFail($id);
        $categories = Category::all();
        $data = [
            'categories' => $categories,
            'category' => $category,
        ];

        return view('admin.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //
        $data = $request->only([
            'name',
            'parent_id',
        ]);

        $category = Category::findOrFail($id);

        try {
            $category->update($data);
        } catch (\Exception $e) {
            return back()->withInput($data)->with('status', 'Update failed!');
        }
        return redirect('admin/categories')->with('status', 'Update success!'); 
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
        $category = Category::findOrFail($id);
        try {
            $category->delete();
        } catch (\Exception $e) {
            return back()->with($data)->with('status', 'Delete failed!');
        }
        return redirect('admin/categories')->with('status', 'Delete success!'); 

    }
}
