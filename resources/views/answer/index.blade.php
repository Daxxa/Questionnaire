@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container">
            <h2>Question</h2>
            <div class="container-rel">
                <div class="container-abs">
                    {!! Form::open(['method'=>'DELETE',
                           'route'=>['questions.destroy',$poll,$question]
                           ]) !!}
                    <button onclick="return confirm('Do you want to delete?')" class="btn btn-secondary del">Delete</button>
                    {!! Form::close()!!}
                </div>
                @include('questionEdit')
            </div>


            @include('errors')
            <h4 class="awr-add-title">Add answer</h4>
            <div class="awr-add">
                {!! form($formAdd) !!}

            </div>
            <br>
            <h2>Answers</h2>

            @foreach($forms as $form)
                <div class="answer">
                    <div class="container-rel">
                {!! form($form) !!}
                    <div class="container-abs-del">
                        {!! Form::open(['method'=>'DELETE',
                               'route'=>['answers.destroy',$poll,$question,$form->getModel()]
                               ]) !!}
                        <button onclick="return confirm('Do you want to delete?')" class="btn btn-secondary del">Delete</button>
                        {!! Form::close()!!}
                    </div>
                    </div>
                </div>
                @endforeach

        </div>
    </div>
@endsection