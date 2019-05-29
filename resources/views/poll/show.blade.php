@extends('layouts.app')
@section('tops')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! form_start($formChart); !!}
                <div class="rounded background-purple p-3">
                {!! form_row($formChart->question_1); !!}
                {!! form_row($formChart->answer_1); !!}
                </div>
                {!! form_row($formChart->question_2);
                form_end($formChart);
                !!}
                <div id="chartContainer1" style="height: 370px; width: 100%;"></div>

                @include('errors')

                <br>
                {!! form($form) !!}
                <div class="included-div">
                    <h2>Included questions</h2>
                    {!! form($included_form) !!}
                </div>
            </div>
        </div>
    </div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection
@section('script')
    <script>
        $('.list_question').on('click', function () {
            var list1 = $('#question_1');
            var list2 = $('#question_2');
            if ($(this).attr('id') == list1.attr('id')) {
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('questions.getanswers') }}",
                    dataType: 'JSON',
                    data: {
                        "_method": 'POST',
                        "_token": token,
                        "question_id": $("#question_1 option:selected").val(),
                    },
                    headers: {

                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

                    },
                    success: function (data) {
                        console.log($("#question_1 option:selected").val());
                        console.log(data);
                        $('#answer_1').empty();
                        for (var index in data) {
                            $('#answer_1').append('<option value="' + index + '">' + data[index] + '</option>')

                        }

                    },
                    error: function (err) {
                        console.log('fail');
                    },
                });
            }
        });
        $(document).ready(function() {
            changeChart();
        });
        $('.list_question').change(function () {
           changeChart();
        });
        function changeChart() {
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: "{{ route('questions.updateChart') }}",
                dataType: 'JSON',
                data: {
                    "_method": 'POST',
                    "_token": token,
                    "question_1": $("#question_1 option:selected").val(),
                    "question_2": $("#question_2 option:selected").val(),
                    "answer_1": $("#answer_1 option:selected").val(),
                },
                headers: {

                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

                },
                success: function (data) {
                    console.log(data);
                    makeChart(data);
                },
                error: function (err) {
                    console.log('fail');
                },
            });
        }
        function makeChart(dataq) {

            var chart = new CanvasJS.Chart("chartContainer1", {
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                exportEnabled: true,
                animationEnabled: true,
                title: {
                    text: "Dependence"
                },
                data: [{
                    type: "pie",
                    indexLabel: "#percent%",
                    percentFormatString: "#0.##",
                    toolTipContent: "{y} (#percent%)",
                    dataPoints:
                    dataq

                }]
            });
            chart.render();
        }

    </script>
    <script>


        $('.chart-btn').on('click', function () {


            var question_id = $(this).attr('id').replace('chart-', "");
            if ($('#chartContainer-' + question_id).length) {
                $('#chartContainer-' + question_id).remove()
            } else {

                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({

                    type: 'POST',
                    url: "{{ route('questions.chart') }}",
                    dataType: 'JSON',
                    data: {
                        "_method": 'POST',
                        "_token": token,
                        "question_id": question_id,
                        "poll_id": {{ $poll->id }}
                    },
                    headers: {

                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

                    },
                    success: function (data) {
                        console.log(data);
                        $('#chart-' + question_id).after($('<div id="chartContainer-' + question_id + '"  style="height: 370px; width: 100%;"></div>'));

                        var chart = new CanvasJS.Chart("chartContainer-" + question_id, {
                            animationEnabled: true,
                            theme: "light2",
                            title: {
                                text: " "
                            },
                            axisY: {
                                title: "Count"
                            },
                            data: [{
                                type: "column",
                                yValueFormatString: "#",
                                dataPoints: data,

                            }]
                        });
                        chart.render();

                    },
                    error: function (err) {
                        alert('fail');
                    },
                });


            }
        });
        
    </script>
@endsection
