@extends('admin.app')
@section('content')

    <h1>USERS</h1>
    <hr>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->name}}</th>
                <td>{{$user->email}}</td>
                <td>
                    <button onclick="location.href='{{route('admin.polls',$user)}}'" type="button"
                            class="btn btn-secondary">Polls
                    </button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>



@endsection