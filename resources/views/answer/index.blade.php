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
            @if(isset($formAdd))
                <h4 class="awr-add-title">Add answer</h4>
                <div class="awr-add">
                    {!! form($formAdd) !!}

                </div>
                <br>
            @endif

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
@section('script')
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <!-- include summernote css/js-->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    <script>
        $(document).ready(function() {
            $('.editor-body').summernote();
        });
    </script>
    @endsection