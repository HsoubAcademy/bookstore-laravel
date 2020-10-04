<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();
        return view('admin.publishers.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publishers.create');
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
    
        $publisher = new Publisher;
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->save();
    
        session()->flash('flash_message',  'تمت إضافة الناشر بنجاح');
    
        return redirect(route('publishers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $this->validate($request, ['name' => 'required']);
    
        $publisher->name = $request->name;
        $publisher->address = $request->address;
        $publisher->save();
    
        session()->flash('flash_message',  'تم تعديل بيانات الناشر بنجاح');
    
        return redirect(route('publishers.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        session()->flash('flash_message', 'تم حذف الناشر بنجاح');
        return redirect(route('publishers.index'));
    }

    public function result(Publisher $publisher)
    {
        $books = $publisher->books()->paginate(12);
        $title = 'الكتب التابعة للناشر: ' . $publisher->name;
        return view('gallery', compact('books', 'title'));
    }

    public function list()
    {
        $publishers = Publisher::all()->sortBy('name');
        $title = 'الناشرون';
        return view('publishers.index', compact('publishers', 'title'));
    }

    public function search(Request $request)
    {
        $publishers = Publisher::where('name', 'like', "%{$request->term}%")->get()->sortBy('name');
        $title = ' نتائج البحث عن: ' . $request->term;
        return view('publishers.index', compact('publishers', 'title'));
    }
}
