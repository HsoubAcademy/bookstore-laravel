@extends('theme.default')

@section('heading')
تعديل بيانات الناشر
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="card mb-4 col-md-8">
        <div class="card-header text-right">
             عدّل بيانات الناشر      
        </div>
        <div class="card-body">
            <form action="{{ route('publishers.update', $publisher) }}" method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">اسم الناشر</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $publisher->name }}" autocomplete="name">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">الوصف</label>

                    <div class="col-md-6">
                        <textarea id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="address">{{ $publisher->address }}</textarea>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-primary">عدل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection