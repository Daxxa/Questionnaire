@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Create a new poll</h3>
        <div class="row">
            <div class="col-md-8">
                @include('errors')

                {!! form($form) !!}
            </div>
        </div>
    </div>
@endsection