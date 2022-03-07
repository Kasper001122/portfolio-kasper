@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">{{$theme->name}}</div>

                    <div class="card-body">

                        <form action="/theme/{{$theme->id}}" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="name">Theme Name</label>
                                <input name="name" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter name" value="{{$theme->name}}">
                                <small id="nameHelp" class="form-text text-muted">Bootstrap Name</small>
                            </div>
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="form-group">
                                <label for="cdn_url">cdn_url</label>
                                <textarea name="cdn_url" type="text" class="form-control" id="cdn_url" aria-describedby="cdn_urlHelp" placeholder="Enter cdn_url" >{{$theme->cdn_url}}</textarea>
                                <small id="cdn_urlHelp" class="form-text text-muted">Your cdn url goes here</small>
                                @error('cdn_url')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div> <button type="submit" class="btn btn-primary">Edit Theme</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


