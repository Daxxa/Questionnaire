@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="content">
        <h2>Polls</h2>
        <br>
        <button onclick="location.href='{{route('polls.create')}}'" type="button" class="btn btn-secondary">Create a new poll</button>

        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Date of creation</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody >
            @foreach($polls as $poll)

                <tr >
                    <a href="polls/{{$poll->id}}">
                    <th scope="row">{{$poll->title}}</th>
                    <td>{{$poll->text}}</td>
                    <td>{{$poll->created_at}}</td>
                        <td><button onclick="location.href='{{route('polls.link',$poll)}}'" type="button" class="btn btn-secondary">Generete a link</button></td>
                        <td><button onclick="location.href='{{route('polls.edit',$poll)}}'" type="button" class="btn btn-secondary">Edit</button></td>
                    <td>
                        {!! Form::open(['method'=>'DELETE',
                        'route'=>['polls.destroy',$poll]]) !!}
                        <button onclick="return confirm('Do you want to delete?')" class="btn btn-secondary">Delete</button>
                        {!! Form::close() !!}
                    </td>
                    <td><button onclick="location.href='{{route('questions.index',$poll)}}'" type="button" class="btn btn-secondary">Questions</button></td>
                    </a>
                </tr>

            @endforeach
            </tbody>
        </table>



    </div>
    </div>
    @endsection