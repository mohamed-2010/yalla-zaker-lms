<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Grade;
use App\Models\Language;
use App\Models\Subject;
use Exception;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::where('active', 1)
        ->with(['categories', 'grade'])
        ->get();
        return view('dashboard.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::where('active', true)->get();
        $categories = Category::where('active', true)->with('grade')->get();
        return view('dashboard.subjects.create', compact('grades', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|min:1',
                
                'grade_id' => 'required',
            ]);
    
            $subject = new Subject;
            $subject->name = $request->name; // Use default app locale as the main name
            $subject->grade_id = $request->grade_id;
            if ($request->hasFile('image')) {
                $subject->addMedia($request->file('image'))->toMediaCollection('subjects');
            }
            $subject->save();

            $subject->categories()->sync($request->category_ids);

            // return dd($subject);
            return redirect()->route('dashboard.subjects.index')
                            ->with("success", "تم اضافة المادة بنجاح");
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    public function edit($id)
    {
        $grades = Grade::where('active', true)->get();

        $categories = Category::where('active', true)->with('grade')->get();
        $subject = Subject::with(['categories', 'grade'])->find($id);

        return view('dashboard.subjects.edit', compact('subject', 'grades', 'categories'));
    }
    
    public function update(Request $request, $id)
    {
        try {
            // return dd($request->all());
            $request->validate([
                'name' => 'required|min:1',
                
                'grade_id' => 'required|exists:grades,id'
            ]);

            $subject = Subject::find($id);
    
            $subject->name = $request->name;
            $subject->grade_id = $request->grade_id;
            if ($request->hasFile('image')) {
                $subject->clearMediaCollection('subjects');
                $subject->addMedia($request->file('image'))->toMediaCollection('subjects');
            }
            $subject->save();

            $subject->categories()->sync($request->category_ids);
    
            return redirect()->route('dashboard.subjects.index')
                            ->with("success", "تم تعديل المادة بنجاح");
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
            $subject = Subject::find($id);
            $subject->clearMediaCollection('subjects');
            $subject->delete();

            return redirect()->route('dashboard.subjects.index')
                            ->with('success', "تم حذف المادة بنجاح");
        } catch (Exception $e) {
            // Handle the exception and redirect back with an error message
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
