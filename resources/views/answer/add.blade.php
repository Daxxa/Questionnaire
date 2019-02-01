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
        <h3>Add a new answer</h3>
        <div class="row">
            <div class="col-md-8">
                @include('errors')
                {!! form($form) !!}


            </div>
        </div>
    </div>
@endsection