@extends('layouts.app')
@section('content')
    <div class="container">
        <h4>{{$question->title}}</h4>
        {{$question->text}}
        <ul>
        @foreach($answers as $answer)
                <li>{{$answer->title}}</li>
            @endforeach
        </ul>
        <div class="col-md-8 col-md-offset-2">
        <h3>Add a new answer</h3>
        <div class="row">

                @include('errors')
                {!! form($form) !!}


            </div>
        </div>
    </div>
@endsection