@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$theme->name}}</div>
                    <div>Theme Name:  {{$theme->name}}</div>
                    <div> Theme id: {{$theme->id}}

                    </div>
                    <div>
                        <a href="{{$theme->id}}/edit"  class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form action="/theme/{{$theme->id}}"  method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                        <a href="/theme/home" class="btn btn-sm btn-outline-primary">Go back</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
