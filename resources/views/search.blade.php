@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        @if(isset($details))
                                    <div>
                                        <h4> The Search results for your query <b> {{ $query }} </b> are :</h4>

                                    </div>

                                    @foreach($details as $user)

                                    <br>
                                    <img  src="/uploads/avatars/{{ $user->avatar }}" width="100" height="100" >

                                        <a href="{{action('HomeController@read', $user->id)}}">{{ $user->name }} </a>

                                    </br>

                            @endforeach

                        @elseif(isset($message))

                            <p>  {{ $message}}  </p>


                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

