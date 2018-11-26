@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">



                <div class="col-md-8 ">
                    <h3>{{ $post->title }}</h3>
                </div>
                <div class="col-md-7 ">
                    <img src="/uploads/posts/{{$post ->avatar }}" style="width:350px; height:350px;">
                    <a style="float: right;  ">{{ $post->text  }} </a>

                </div>
                <p class="col-md-5">Data Time:{{ $post->created_at  }} </p>
                <span>{{$post->comments->count()}} {{ str_plural('comment', $post->comments->count()) }}</span>

                @if (Auth::check())

                    {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
                    <p>{{ Form::textarea('body', old('body')) }}</p>
                    {{ Form::hidden('post_id', $post->id) }}

                    <p>{{ Form::submit('Send') }}</p>
                    {{ Form::close() }}
                @endif
                @forelse ($post->comments as $comment)
                    <p>{{ $comment->user->name }} {{$comment->created_at}}</p>
                    <p>{{ $comment->body }}</p>
                    <hr>
                @empty
                    <p>This post has no comments</p>
                @endforelse



            </div>
        </div>
    </div>

@endsection