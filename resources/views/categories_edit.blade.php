@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- update/{articles}/articles-->
                <div class="card-header">{{ __('Add Categories') }}</div>
                <form action="{{ ('/update') }}{{ ('/') }}{{ $id }}{{ ('/') }}{{ ('categories') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="exampleInputEmail1">name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="masukan nama kategori" value="{{ $name }}">
                        <!-- error message untuk name -->
                        @error('name')
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