@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">معرض الكتب</div>

                <div class="card-body">
                
                    <div class="row justify-content-center">
                        <form class="form-inline col-md-6 justify-content-center" action="{{ route('search') }}" method="GET">
                            <input type="text" class="form-control mx-sm-3 mb-2" name="term">
                            <button type="submit" class="btn btn-secondary mb-2">ابحث</button>
                        </form>
                    </div>
                    <hr>
                    <br>
                    <h3>{{ $title }}</h3>
                    <div class="row">
                        @if ($books->count())
                            @foreach ($books as $book)
                                @if ($book->number_of_copies > 0)
                                    <div class="col-lg-3 col-md-4 col-6" style="margin-bottom:10px">
                                        <div class="d-block mb-2 h-100 border rounded" style="padding:10px">
                                            <a href="{{ route('book.details', $book->id) }}" style="color:#555555">
                                                <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $book->cover_image) }}" alt="">
                                                <b><p style="height:25px">{{ $book->title }}</p></b>
                                            </a>
                                            <span class="score">
                                                <div class="score-wrap">
                                                    <span class="stars-active" style="width: {{ $book->rate()*20 }}%">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                    
                                                    <span class="stars-inactive">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </span>
                                                </div>
                                            </span>
                                            @if ($book->category != NULL)
                                                <br><a style="color:#525252" href="{{ route('gallery.categories.show', $book->category) }}">{{ $book->category->name }}</a>
                                            @endif

                                            @if ($book->authors->isNotEmpty())
                                                <br><b>تأليف: </b>
                                                @foreach($book->authors as $author)
                                                    {{ $loop->first ? '' : 'و' }}
                                                    <a style="color:#525252" href="{{ route('gallery.authors.show', $author) }}">{{ $author->name }} </a>
                                                @endforeach
                                            @endif

                                            <br>
                                            <b>السعر: </b>{{ $book->price }} $

                                            @auth
                                                <form method="POST" action="{{ route('cart.add') }}">
                                                    @csrf
                                                    <input name="id" type="hidden" value="{{ $book->id }}">
                                                    <input class="form-control" name="quantity" type="number" value="1" min="1" max="{{ $book->number_of_copies }}" style="width:40%; float:right" required>
                                                    <button type="submit" class="btn btn-primary" style="margin-right: 10px"> أضف <i class="fas fa-cart-plus"></i></button>
                                                </form>
                                            @endauth
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <h3 style="margin:0 auto">لا نتائج</h3>
                        @endif
                    </div>
                    {{ $books->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection