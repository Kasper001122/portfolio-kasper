@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Edit Post</div>

                    <div class="card-body">

                        <form action="/post/{{$post->id}}" method="post">
                            @method('PATCH')

                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" type="text" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Enter title" value="{{$post->title}}">
                                <small id="titleHelp" class="form-text text-muted">Add a interesting title to catch eyes</small>
                            </div>
                            @error('title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" type="text" class="form-control" id="content" aria-describedby="contentHelp" placeholder="Enter content" >{{$post->content}}</textarea>
                                <small id="contentHelp" class="form-text text-muted">The body of your content goes here</small>
                                @error('content')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div> <button type="submit" class="btn btn-primary">Edit Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
