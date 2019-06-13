@extends('layouts.app')

@section('content')
<h2>{{$title}}</h2>
<div>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'PATCH']) !!}
        {{ Form::hidden('_method', 'PATCH') }}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
        </div>
        <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text']) }}
        </div>
        {{ Form::submit('Post', ['class' => 'btn btn-primary']) }}
    {!! Form::close() !!}
</div>
@endsection