<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Grade;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('active', 1)->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::where('active', true)->get();
        return view('dashboard.categories.create', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:1',
                
                'grade_id' => 'required'
            ]);
    
            $category = new Category;
            $category->name = $request->name; // Use default app locale as the main name
            $category->grade_id = $request->grade_id;
            $category->save();

            return redirect()->route('dashboard.categories.index')
                            ->with("success", "تم اضافة القسم بنجاح");
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $grades = Grade::where('active', true)->get();
        $category = Category::find($id);
        return view('dashboard.categories.edit', compact('category', 'grades'));
    }
    
    public function update(Request $request, $id)
    {
        try {
            // return dd($request->all());
            $request->validate([
                'name' => 'required|min:1',
                
                'grade_id' => 'required|exists:grades,id'
            ]);

            $category = Category::find($id);
    
            $category->name = $request->name;
            $category->grade_id = $request->grade_id;
            $category->save();
    
            return redirect()->route('dashboard.categories.index')
                            ->with("success", "تم تعديل القسم بنجاح");
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $category->delete();
    
            return redirect()->route('dashboard.categories.index')
                            ->with('success', "تم حذف القسم بنجاح");
        } catch (Exception $e) {
            // Handle the exception and redirect back with an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
