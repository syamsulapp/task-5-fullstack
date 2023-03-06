@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>
                <br>
                <a href="{{ route('create.categories') }}"><button type="button" class="btn btn-primary col-md-4">{{ ('Add Categories')}}</button></a>
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
                                <th>Name</th>
                                <th>Users</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                            <tr>
                                <td>{{ $d->id }}</td>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->users_id }}</td>
                                <td>
                                    <a href="{{ url('/edit') }}{{ ('/') }}{{ $d->id }}{{ ('/') }}{{ ('categories') }}"><button type="button" class="btn btn-info">edit</button></a>
                                    <form action="{{ url('/delete') }}{{ ('/') }}{{ $d->id }}{{ ('/') }}{{ ('categories') }}" method="POST">
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
                                <th>Name</th>
                                <th>Users</th>
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