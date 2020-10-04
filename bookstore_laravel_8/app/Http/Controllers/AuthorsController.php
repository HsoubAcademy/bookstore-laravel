<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();
        return view('admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
    
        $author = new Author;
        $author->name = $request->name;
        $author->description = $request->description;
        $author->save();
    
        session()->flash('flash_message',  'تمت إضافة المؤلف بنجاح');
    
        return redirect(route('authors.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        $this->validate($request, ['name' => 'required']);
    
        $author->name = $request->name;
        $author->description = $request->description;
        $author->save();
    
        session()->flash('flash_message',  'تم تعديل بيانات المؤلف بنجاح');
    
        return redirect(route('authors.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        session()->flash('flash_message', 'تم حذف المؤلف بنجاح');
        return redirect(route('authors.index'));
    }

    public function result(Author $author)
    {
        $books = $author->books()->paginate(12);
        $title = 'الكتب التابعة للمؤلف: ' . $author->name;
        return view('gallery', compact('books', 'title'));
    }

    public function list()
    {
        $authors = Author::all()->sortBy('name');
        $title = 'المؤلفون';
        return view('authors.index', compact('authors', 'title'));
    }

    public function search(Request $request)
    {
        $authors = Author::where('name', 'like', "%{$request->term}%")->get()->sortBy('name');
        $title = ' نتائج البحث عن: ' . $request->term;
        return view('authors.index', compact('authors', 'title'));
    }
}
