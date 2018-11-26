@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">



                        <div class="col-md-8 ">
                        <h3>{{ $pages->title }}</h3>
                        </div>
                    <div class="col-md-7 ">
                        <img src="/uploads/posts/{{$pages ->avatar }}" style="width:350px; height:350px;">
                        <a style="float: right;  ">{{ $pages->text  }} </a>

                    </div>
                <p class="col-md-5">Data Time:{{ $pages->created_at  }} </p>
                <span>{{$pages->comments->count()}} {{ str_plural('comment', $pages->comments->count()) }}</span>

                @if (Auth::check())

                    {{ Form::open(['route' => ['comments.store'], 'method' => 'POST']) }}
                    <p>{{ Form::textarea('body', old('body')) }}</p>
                    {{ Form::hidden('post_id', $pages->id) }}

                    <p>{{ Form::submit('Send') }}</p>
                    {{ Form::close() }}
                @endif
                @forelse ($pages->comments as $comment)
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
