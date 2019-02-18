@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
        <h2>Create a new poll</h2>
        <div class="row">
                @include('errors')

                {!! form($form) !!}
            </div>
        </div>
    </div>
@endsection