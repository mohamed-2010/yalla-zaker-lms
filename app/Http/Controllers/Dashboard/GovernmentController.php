<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Government;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GovernmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $governments = Government::all();
            return view('dashboard.governments.index', compact('governments'));
        }catch(Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "حدث مشكله اثناء تنفيذ العمليه الرجاء المحاوله مره اخري او العوده للشركه المصممه مع وقت حدوث المشكله");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('dashboard.governments.create');
        }catch(Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "حدث مشكله اثناء تنفيذ العمليه الرجاء المحاوله مره اخري او العوده للشركه المصممه مع وقت حدوث المشكله");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => "required"
            ]);

            $government = new Government;
            $government->name = $request->name;
            $government->save();

            return redirect(route('dashboard.governments.index'))->with('success', "تم اضافة المحافظه بنجاح");
        }catch(Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "حدث مشكله اثناء تنفيذ العمليه الرجاء المحاوله مره اخري او العوده للشركه المصممه مع وقت حدوث المشكله");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Government $government)
    {
        try {
            
        }catch(Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "حدث مشكله اثناء تنفيذ العمليه الرجاء المحاوله مره اخري او العوده للشركه المصممه مع وقت حدوث المشكله");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $government = Government::findOrfail($id);
            return view('dashboard.governments.edit', compact('government'));
        }catch(Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "حدث مشكله اثناء تنفيذ العمليه الرجاء المحاوله مره اخري او العوده للشركه المصممه مع وقت حدوث المشكله");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => "required"
            ]);

            $government = Government::findOrfail($id);
            $government->name = $request->name;
            $government->save();

            return redirect(route('dashboard.governments.index'))->with('success', "تم تعديل المحافظه بنجاح");
        }catch(Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "حدث مشكله اثناء تنفيذ العمليه الرجاء المحاوله مره اخري او العوده للشركه المصممه مع وقت حدوث المشكله");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $government = Government::findOrfail($id);
            $government->delete();
            return redirect(route('dashboard.governments.index'))->with('success', "تم حذف المحافظه بنجاح");
        }catch(Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "حدث مشكله اثناء تنفيذ العمليه الرجاء المحاوله مره اخري او العوده للشركه المصممه مع وقت حدوث المشكله");
        }
    }
}
