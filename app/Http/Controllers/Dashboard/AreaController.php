<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Government;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $areas = Area::all();
            return view('dashboard.areas.index', compact('areas'));
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
            $governments = Government::all();
            return view('dashboard.areas.create', compact('governments'));
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
                'name' => "required",
                'government_id' => "required"
            ]);

            $area = new Area;
            $area->name = $request->name;
            $area->government_id = $request->government_id;
            $area->save();

            return redirect(route('dashboard.areas.index'))->with('success', "تم اضافة المنطقه بنجاح");
        }catch(Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "حدث مشكله اثناء تنفيذ العمليه الرجاء المحاوله مره اخري او العوده للشركه المصممه مع وقت حدوث المشكله");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
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
            $area = Area::findOrfail($id);
            $governments = Government::all();
            return view('dashboard.areas.edit', compact('area', 'governments'));
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
                'name' => "required",
                'government_id' => "required"

            ]);

            $area = Area::findOrfail($id);
            $area->name = $request->name;
            $area->government_id = $request->government_id;
            $area->save();

            return redirect(route('dashboard.areas.index'))->with('success', "تم تعديل المنطقه بنجاح");
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
            $area = Area::findOrfail($id);
            $area->delete();

            return redirect(route('dashboard.areas.index'))->with('success', "تم حذف المنطقه بنجاح");
        }catch(Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "حدث مشكله اثناء تنفيذ العمليه الرجاء المحاوله مره اخري او العوده للشركه المصممه مع وقت حدوث المشكله");
        }
    }

}
