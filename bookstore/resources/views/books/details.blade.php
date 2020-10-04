@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">عرض تفاصيل الكتاب</div>

                <div class="card-body">
                    <table class="table table-stribed">
                        <tr>
                            <th>العنوان</th>
                            <td class="lead"><b>{{ $book->title }}</b></td>
                        </tr>

                        <tr>
                            <th>تقييم المستخدمين</th>
                            <td>
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
                                <span>عدد المقيّمين {{ $book->ratings()->count() }} مستخدم</span>
                            </td>
                        </tr>

                        @if ($book->isbn)
                            <tr>
                                <th>الرقم التسلسلي</th>
                                <td>{{ $book->isbn }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>صورة الغلاف</th>
                            <td><img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $book->cover_image) }}"></td>
                        </tr>
                        @if ($book->category)
                            <tr>
                                <th>التصنيف</th>
                                <td>{{ $book->category->name }}</td>
                            </tr>
                        @endif
                        @if ($book->authors()->count() > 0)
                            <tr>
                                <th>المؤلفون</th>
                                <td>
                                    @foreach ($book->authors as $author)
                                        {{ $loop->first ? '' : 'و' }}
                                        {{ $author->name }}
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                        @if ($book->publisher)
                            <tr>
                                <th>الناشر</th>
                                <td>{{ $book->publisher->name }}</td>
                            </tr>
                        @endif
                        @if ($book->description)
                            <tr>
                                <th>الوصف</th>
                                <td>{{ $book->description }}</td>
                            </tr>
                        @endif
                        @if ($book->publish_year)
                            <tr>
                                <th>سنة النشر</th>
                                <td>{{ $book->publish_year }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>عدد الصفحات</th>
                            <td>{{ $book->number_of_pages }}</td>
                        </tr>
                        <tr>
                            <th>عدد النسخ</th>
                            <td>{{ $book->number_of_copies }}</td>
                        </tr>
                        <tr>
                            <th>السعر</th>
                            <td>{{ $book->price }} $</td>
                        </tr>
                    </table>
                    @auth
                        <h4>قيّم هذا الكتاب<h4>
                        @if ($bookfind)
                            @if(auth()->user()->rated($book))
                                <div class="rating">
                                    <span class="rating-star {{ auth()->user()->bookRating($book)->value == 5 ? 'checked' : '' }}" data-value="5"></span>
                                    <span class="rating-star {{ auth()->user()->bookRating($book)->value == 4 ? 'checked' : '' }}" data-value="4"></span>
                                    <span class="rating-star {{ auth()->user()->bookRating($book)->value == 3 ? 'checked' : '' }}" data-value="3"></span>
                                    <span class="rating-star {{ auth()->user()->bookRating($book)->value == 2 ? 'checked' : '' }}" data-value="2"></span>
                                    <span class="rating-star {{ auth()->user()->bookRating($book)->value == 1 ? 'checked' : '' }}" data-value="1"></span>
                                </div>
                            @else
                                <div class="rating">
                                    <span class="rating-star" data-value="5"></span>
                                    <span class="rating-star" data-value="4"></span>
                                    <span class="rating-star" data-value="3"></span>
                                    <span class="rating-star" data-value="2"></span>
                                    <span class="rating-star" data-value="1"></span>
                                </div>
                            @endif
                        @else
                        <div class="alert alert-danger" role="alert">
                            يجب شراء الكتاب لتستطيع تقيمه
                        </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('.rating-star').click(function() {
            
            var submitStars = $(this).attr('data-value');

            $.ajax({
                type: 'post',
                url: {{ $book->id }} + '/rate',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'value' : submitStars
                },
                success: function() {
                    alert('تمت عملية التقييم بنجاح');
                    location.reload();
                },
                error: function() {
                    alert('حدث خطأ ما');
                },
            });
        });
    </script>
@endsection