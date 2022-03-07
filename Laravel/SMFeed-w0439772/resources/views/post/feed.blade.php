@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{--the flash message page             https://www.itsolutionstuff.com/post/laravel-5-implement-flash-messages-with-exampleexample.html--}}
                    <div class="card-body">
                        @include('post/flash-message')

                        @yield('content')


                            @auth
                                <a href="/post/create" class="btn btn-dark">Create New Post</a>
                            @else
                            @endauth


    @foreach($posts->reverse() as $post)
                            <div class="card">
                                <div class="card-header">{{$post->title}} <small class="text-secondary">
                                        <div>Posted at: {{date('d M Y - H:i',$post->created_at->timestamp)}}
                                        </div><div>Posted by {{\App\User::where(['id'=>$post->created_by])->pluck('name')->first()}}</div></small></div>
{{--https://stackoverflow.com/questions/42108928/querying-inside-a-blade-view-in-laravel for the pluck--}}
{{--                            @if(\App\User::isUserAdmin())--}}
{{--                                hihihihihihi--}}
{{--                                @endif--}}
                            <div class="card-body"> {{$post->content}}
                                <div>

                                @if($mod==true || auth()->id()==$post->created_by)
                                    <form action="/post/{{$post->id}}"  method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

                                        @if(auth()->id()==$post->created_by)
                                            <a href="/post/{{$post->id}}/edit"  class="btn btn-sm btn-outline-secondary">Edit</a>@endif
                                @endif

                                </div>
                                <div>

                            </div>
                            </div>
                            </div>
    @endforeach
                    </div></div></div> </div>
@endsection
