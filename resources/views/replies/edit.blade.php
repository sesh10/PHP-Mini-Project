@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Edit Comment</h1>
    <h4>Name - {{$comment->user->name}}</h4>
    {!! Form::open(['action' => ['repliesController@update',$post->id , $comment->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('body', 'Comment')}}
            {{Form::textarea('body', $comment->content, ['id' => 'article-ckeditor', 'class' => 'form-control'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
  </div>

@endsection
