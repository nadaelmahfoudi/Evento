<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::all();
        
        return view('dashboard',compact('categorys'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
       
    }

    public function archive()
    {
        $categorys = Category::onlyTrashed()->get();
        
        return view('dashboard',compact('categorys'));
       
    }

    public function all()
    {
        $categorys = Category::withTrashed()->get();
        
        return view('dashboard',compact('categorys'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
  
        return view('Admin.categorys.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        
        Category::create($request->validated());
         
        return redirect()->route('dashboard')
                        ->with('success','Company created successfully.');
;
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categorys.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categorys.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
       
        $category->update($request->validated());
        
        return redirect()->route('dashboard')
                        ->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
      
        $category->delete();
         
        return redirect()->route('dashboard')
                        ->with('success','Company deleted successfully');
    }

    // public function showDashboard()
    // {
    //     $categorys = Category::all(); 
    //     return view('dashboard', compact('categorys'));
    // }
}