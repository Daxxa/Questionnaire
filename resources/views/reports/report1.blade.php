@extends('layouts.app')
@section('content')
    <button onclick="location.href='{{route('polls.report.pdf',$poll)}}'" type="button" class="btn btn-secondary">Save PDF</button>

    <br>
    <br>
    <div class="report">
        <h1>REPORT</h1>
        <hr>
        <table class="table table-bordered">
            <thead>
            <tr style="    background-color: #ddd5d0;
    font-size: 20px;">
                <th scope="col">Question</th>
                <th scope="col">Answer</th>
                <th scope="col">Count</th>
                <th scope="col">Percent</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                @if($prev == $report->Qid)
                    <tr>
                @else
                    <tr style="border-top: 5px solid #ddd5d0;">
                        @endif
                        <th scope="row">{{ $report->Question }}</th>
                        <td><?= $report->Answer ?></td>
                        <td>{{ $report->Count }}</td>
                        <td><b>{{ $report->Co }} %</b></td>
                    </tr>
                    @php
                        $prev = $report->Qid
                    @endphp

                    @endforeach
                    <tr style="background-color: rgba(221,182,213,0.57);border-top: 5px solid #ddd5d0;font-size: 20px; color: white;">
                        <th scope="row">Questions: {{$questionCount}}</th>
                    </tr>
            </tbody>
        </table>
        <hr>

        <h2>Count of respondents: {{$anonCount}}</h2>
    </div>
@stop
@section('script')
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>

@stop