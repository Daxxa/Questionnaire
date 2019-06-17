@extends('layouts.app')
@section('content')
    {!! Form::open(['method'=>'POST','route'=>['polls.questions.post'], 'id'=>'formPDF']) !!}
        <input type="text" name="poll" value="{{ $poll->id }}" hidden>
        <input type="text" name="question" value="{{$reports->first()->Qid}}" hidden>
        <button type="submit" id="pdf" class="btn btn-secondary">Save PDF</button>
    {!! Form::close() !!}

        <select class="form-control btn ss" style="width: 340px" onchange="action=this.value">
            @foreach($questions as $question)
                <option value='{{ $question->id }}' id="{{ $question->id }}"
                        class="optionQ">{{ $question->title }}</option>
            @endforeach
        </select>
        <br>
        <br>
    <div class="report">
        <h1>REPORT</h1>
        <hr>
        <h2>{{ $reports->first()->Question }}</h2>
        <table class="table table-bordered">
            <thead>
            <tr style="    background-color: #ddd5d0;
    font-size: 20px;">
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
                        <td style="font-size: 40px">{{ $report->Answer }}</td>
                        <td style="font-size: 40px">{{ $report->Count }}</td>
                        <td style="font-size: 30px"><b>{{ $report->Co }} %</b></td>
                    </tr>
                    @php
                        $prev = $report->Qid
                    @endphp

                    @endforeach

            </tbody>
        </table>
        <hr>

        <h2>Count of respondents: {{$anonCount}}</h2>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <br>
        <br>
        <br>

        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>


        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    </div>
@stop
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>

    <script>

        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Diagram - 1"
            },
            data: [{
                type: "pie",
                startAngle: 240,
                yValueFormatString: "##0.00\"%\"",
                indexLabel: "{label} {y}",
                dataPoints: <?= $chart  ?>
            }]
        });
        chart.render();
        img1 = chart.canvas.toDataURL();


        var chart = new CanvasJS.Chart("chartContainer2", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Diagram - 2"
            },
            exportEnabled: true,
            axisY: {
                title: "Count"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                legendText: "Answers",
                dataPoints: <?= $chart2  ?>
            }]
        });
        chart.render();
        var img2 = chart.canvas.toDataURL();


        $('#formPDF').append('<input type="text" name="img1" value="'+img1+'" hidden>');
        $('#formPDF').append('<input type="text" name="img2" value="'+img2+'" hidden>');

        $('.ss').on('click', function () {
            var question_id = $(this).children("option:selected").val();
            window.location.href = "http://localhost:8000/polls/<?= $poll->id ?>/report2/" + question_id;
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: "{{ route('polls.questions.post') }}",
                dataType: 'JSON',
                data: {
                    "_method": 'POST',
                    "_token": token,
                    "question_id": question_id,
                    "charts": [
                        img1, img2
                    ]
                },
                headers: {

                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

                },
                success: function (data) {
                    console.log(data);
                    $('#answer_1').append('<option value="' + index + '">' + data[index] + '</option>')

                },
                error: function (err) {
                    console.log('fail');
                },
            });
        });


    </script>



@stop