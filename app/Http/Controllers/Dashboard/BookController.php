<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Grade;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            $books = Book::all();
        }else{
            $books = Book::where('teacher_id', Auth::user()->id);
        }

        return view('dashboard.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::where('active', 1)->get();
        $teachers = Teacher::with(['subjects', 'subjects.grade'])->get();

        return view('dashboard.books.create', compact('grades', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|string',
            'grade_id' => 'required|exists:grades,id',
            // 'teacher_id' => 'required|exists:teachers,id',
        ]);

        $book = new Book;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->grade_id = $request->grade_id;
        $book->teacher_id = Auth::user()->hasRole('admin') ? $request->teacher_id : Auth::user()->id;

        if($request->hasFile('cover')) {
            $book->addMedia($request->file('cover'))->toMediaCollection('books');
        }

        $book->save();

        return redirect()->route('dashboard.books.index')->with('success', 'تم إضافة الكتاب بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::findOrfail($id);
        $grades = Grade::where('active', 1)->get();
        $teachers = Teacher::with(['subjects', 'subjects.grade'])->get();
        return view('dashboard.books.edit', compact('book', 'grades', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrfail($id);
        $book->name = $request->name;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->grade_id = $request->grade_id;
        $book->teacher_id = $request->teacher_id;

        if($request->hasFile('cover')) {
            $book->clearMediaCollection('books');
            $book->addMedia($request->file('cover'))->toMediaCollection('books');
        }

        $book->save();

        return redirect()->route('dashboard.books.index')->with('success', 'تم تعديل الكتاب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrfail($id);
        $book->clearMediaCollection('books');
        $book->delete();

        return redirect()->route('dashboard.books.index')->with('success', 'تم حذف الكتاب بنجاح');
    }
}
