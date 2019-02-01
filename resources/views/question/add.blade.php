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