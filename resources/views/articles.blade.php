@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Articles') }}</div>
                <br>
                <a href="{{ route('create.articles') }}"><button type="button" class="btn btn-primary col-md-4">{{ ('Add Articles')}}</button></a>
                <br>
                @if(Session::has('message'))

                <div class="alert alert-success mt-2"> {{ Session::get('message') }}</div>
                @endif
                <br>
                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Category</th>
                                <th>Users</th>
                                <th>image</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->title }}</td>
                                <td>{{ $d->content }}</td>
                                <td>{{ $d->category_id }}</td>
                                <td>{{ $d->users_id }}</td>
                                <td><img src="{{ $d->image }}" width="80" height="80"></img></td>
                                <td>
                                    <a href="{{ url('/edit') }}{{ ('/') }}{{ $d->id }}{{ ('/') }}{{ ('articles') }}"><button type="button" class="btn btn-info">edit</button></a>
                                    <form action="{{ url('/delete') }}{{ ('/') }}{{ $d->id }}{{ ('/') }}{{ ('articles') }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Category</th>
                                <th>Users</th>
                                <th>image</th>
                                <th>action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection