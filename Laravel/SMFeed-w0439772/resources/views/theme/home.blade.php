@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif



                        <a href="/theme/create" class="btn btn-dark">Create New Theme</a>
                </div>

                </div>
                <div class="card mt-4">
                    <div class="card-header">Themes</div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                ID Name</li>
                            @foreach($themes as $theme)
                                <li class="list-group-item">
                                    {{$theme->id}}
                                    {{$theme->name}}    </li>
                                <li class="list-group-item d-flex justify-content-around">
                                    <a href="/theme/{{$theme->id}}"  class="btn btn-sm btn-outline-success">Details</a>
                                    <a href="/theme/{{$theme->id}}/edit"  class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="/theme/{{$theme->id}}"  method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
