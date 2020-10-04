<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index()
    {
        $number_of_books = Book::count();
        $number_of_categories = Category::count();
        $number_of_authors = Author::count();
        $number_of_publishers = Publisher::count();
    
        return view('admin.index', compact('number_of_books', 'number_of_categories', 'number_of_authors', 'number_of_publishers'));
    }
}
