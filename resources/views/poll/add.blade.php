@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Create a new poll</h3>
        <div class="row">
            <div class="col-md-8">
                {!! Form::open(['route'=>['polls.store']]) !!}
                @include('errors')

                <div class="form-group">
                    Name
                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                    <br>
                    Description
                    <textarea type="text" class="form-control"name="text" cols="30" rows="10" value="{{old('text')}}">
                    </textarea>
                    <br>
                    <button class="btn button-secondary">Create</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection