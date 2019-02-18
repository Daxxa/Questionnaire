@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">

        <h2>Edit poll '{{$poll->title}}'</h2>
        <div class="row">
                @include('errors')

                Date of creation - {{$poll->created_at}}
                <br>
                {!! form($form) !!}
            </div>
        </div>
    </div>
@endsection