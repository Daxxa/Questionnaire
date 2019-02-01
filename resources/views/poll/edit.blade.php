@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Edit poll '{{$poll->title}}'</h3>
        <div class="row">
            <div class="col-md-8">
                @include('errors')

                Date of creation - {{$poll->created_at}}
                <br>
                {!! form($form) !!}
            </div>
        </div>
    </div>
@endsection