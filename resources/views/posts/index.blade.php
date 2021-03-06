@extends('layouts.app')

@section('content')
    <h2>{{$title}}</h2>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="card" style="width: 60%; margin-bottom: 30px;">
                <img src="{{asset('images/post-default.png')}}" class="card-img-top" alt="{{$post->title}}">
                <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{!!$post->body!!}</p>
                    <a href="/posts/{{$post->id}}" class="btn btn-success">View Post</a>
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit Post</a>
                    {!! Form::open(['url' => '/posts/'.$post->id , 'method' => 'DELETE', 'style' => 'display: inline;']) !!}
                        {{ Form::hidden('_method', 'DELETE') }}
                        <input type="submit" value="Delete Post" class="btn btn-danger" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete post?');"/>
                    {!! Form::close() !!}
                </div>
            </div>
        @endforeach
            {{$posts->links()}}
    @else
        <p>No Posts Found</p>
    @endif
@endsection