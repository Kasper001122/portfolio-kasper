@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$user->name}}</div>
                    <div>Email: {{$user->email}}</div>
                    <div> Role(s):
                    @foreach($user->roles as $role)
                    <div>{{$role->name}}</div>
                    @endforeach
                    </div>
                    <div>
                    <a href="{{$user->id}}/edit"  class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form action="/user/admin/{{$user->id}}"  method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    <a href="/home" class="btn btn-sm btn-outline-primary">Go Home</a>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
