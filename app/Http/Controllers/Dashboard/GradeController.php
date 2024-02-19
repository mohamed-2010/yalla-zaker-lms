<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\GradeTranslation;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::where('active', 1)->get();
        return view('dashboard.grads.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.grads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:1',
            ]);
    
            $grade = new Grade;
            $grade->name = $request->name; // Use default app locale as the main name
            if ($request->hasFile('image')) {
                $grade->addMedia($request->file('image'))->toMediaCollection('grades');
            }
            $grade->save();
    
            return redirect()->route('dashboard.grades.index')
                            ->with("success","تم اضافة الصف بنجاح");
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    public function edit($id)
    {
        $grade = Grade::find($id);
        return view('dashboard.grads.edit', compact('grade'));
    }
    
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|min:1',
                
            ]);

            $grade = Grade::find($id);
    
            $grade->name = $request->name;
            // return dd($request->all());
            if ($request->hasFile('image')) {
                $grade->clearMediaCollection('grades');
                $grade->addMedia($request->file('image'))->toMediaCollection('grades');
            }
            $grade->save();
    
            return redirect()->route('dashboard.grades.index')
                            ->with("success", "تم تعديل الصف بنجاح");
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
            $grade = Grade::find($id);
            $grade->clearMediaCollection('grades');
            $grade->delete();
    
            return redirect()->route('dashboard.grades.index')
                            ->with('success', "تم حذف الصف بنجاح");
        } catch (Exception $e) {
            // Handle the exception and redirect back with an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}