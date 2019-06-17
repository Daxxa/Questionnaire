@extends('admin.app')
@section('content')

    <h1>POLLS</h1>
    <h2>User - <b>{{$user->name}}</b></h2>
    <hr>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Date of creation</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($polls as $poll)

            <tr>
                <a href="polls/{{$poll->id}}">
                    <th scope="row">{{$poll->title}}</th>
                    <td>{{$poll->text}}</td>
                    <td>{{$poll->created_at}}</td>
                    <td>
                        <button onclick="location.href='{{route('admin.questions',[$poll, $user])}}'" type="button"
                                class="btn btn-secondary">Questions
                        </button>
                    </td>

                    <td>
                        {!! Form::open(['method'=>'DELETE',
                        'route'=>['polls.destroy',$poll]]) !!}
                        <button type="submit" class="btn btn-secondary" id="delete-{{$poll->id}}">Delete</button>
                        {!! Form::close() !!}
                    </td>


                </a>
            </tr>

        @endforeach
        </tbody>
    </table>



@endsection