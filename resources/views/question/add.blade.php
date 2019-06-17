@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Add a new question</h3>
        <div class="row">
            <div class="col-md-8">
                @include('errors')

                {!! form($form) !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    <script>
        $(document).ready(function() {
            $('.editor-body').summernote();
        });
    </script>
    @endsection