@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container">
        <h2>Questions</h2>
            @include('errors')
        <button onclick="location.href='{{route('questions.create',$poll)}}'" type="button" class="btn btn-secondary">Add a new question</button>
            <br><br>
            @foreach($questions as $question)
                <div class="container-rel">
                <div class="container-abs">
                {!! Form::open(['method'=>'DELETE',
                       'route'=>['questions.destroy',$poll,$question]
                       ]) !!}
                <button onclick="return confirm('Do you want to delete?')" class="btn btn-secondary del">Delete</button>
                {!! Form::close()!!}
                </div>

                @include('questionEdit')
                    <div class="awr-btn">
                        <button onclick="location.href='{{route('answers.index',[$poll,$question])}}'" type="button" class="btn btn-secondary">Answers</button>
                    </div>
                </div>

            @endforeach


    </div>
    </div>
@endsection