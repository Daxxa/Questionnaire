@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="content">
        <h2>Polls</h2>
        <br>
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
                    <td></td>
                    <td>

                    </td>
                    <td></td>
                    </a>
                </tr>

            @endforeach
            </tbody>
        </table>



    </div>
    </div>
    @endsection