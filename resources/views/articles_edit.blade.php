@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- update/{articles}/articles-->
                <div class="card-header">{{ __('Add Articles') }}</div>
                <form action="{{ ('/update') }}{{ ('/') }}{{ $id }}{{ ('/') }}{{ ('articles') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="exampleInputEmail1">title</label>
                        <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="masukan title" value="{{ $title }}">
                        <!-- error message untuk title -->
                        @error('title')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">content</label>
                            <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $content }}</textarea>
                        </div>
                        @error('content')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">image</label>
                        <input type="text" class="form-control" name="image" id="exampleInputPassword1" placeholder="masukan image dari google" value="{{ $image }}">
                        @error('image')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">category</label>
                        <input type="number" class="form-control" name="category" id="exampleInputPassword1" placeholder="input kategory" value="{{ $category_id }}">
                        @error('category')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    @endsection