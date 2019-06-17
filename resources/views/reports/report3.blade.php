@extends('layouts.app')
@section('content')
    {!! Form::open(['method'=>'POST','route'=>['polls.questions.post'], 'id'=>'formPDF']) !!}
    <input type="text" name="poll" value="{{ $poll->id }}" hidden>
    <input type="text" name="question" value="{{$reports->first()->Qid}}" hidden>
    <button type="submit" id="pdf" class="btn btn-secondary">Save PDF</button>
    {!! Form::close() !!}
    <br>

    <select class="form-control btn question" style="width: 340px" onchange="action=this.value"
            selected="{{$defaultQuestion->id}}">
        @foreach($questions as $question)
            <option value='{{ $question->id }}' id="{{ $question->id }}"
                    class="optionQ"
                    @if($question->id == $defaultQuestion->id)
                    selected
                    @endif
            >{{ $question->title }}</option>
        @endforeach
    </select>

    <div class="answers"></div>
    <br>
    <br>
    <div class="report">
        <div class="reportChild">
            <h1>REPORT</h1>
            <hr>
            <h2>{{$defaultQuestion->title }}</h2>
            <h3>Answer: {{$defaultAnswer->title }}</h3>
            <h2>Count of respondents: {{$anonCount}}</h2>
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
                            <td style="font-size: 30px">{{ $report->Question }}</td>
                            <td style="font-size: 40px">{{ $report->Answer }}</td>
                            <td style="font-size: 40px">{{ $report->Count }}</td>
                            <td style="font-size: 30px"><b>{{ $report->Qid }} %</b></td>
                        </tr>
                        @php
                            $prev = $report->Qid
                        @endphp

                        @endforeach

                </tbody>
            </table>
            <hr>
        </div>


    </div>
@stop
@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmJ9rM5F57pR9UmeNDQ3tj9VoP89_bccE"
            async defer></script>
    <script>
        console.log(<?= $defaultAnswer->id ?>);
        answers(<?= $defaultQuestion->id ?>);
        $('.question').on('click', function () {
            var question_id = $(this).children("option:selected").val();
            //dd
            answers(question_id);
        });

        function answers(question_id) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: "{{ route('report3.question') }}",
                dataType: 'JSON',
                data: {
                    "_method": 'POST',
                    "_token": token,
                    "question_id": question_id,
                },
                headers: {

                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

                },
                success: function (data) {
                    if (data['type'] == 'multiply') {
                        var options = "";
                        Object.keys(data['answers']).forEach(function (key) {
                            if (key == <?= $defaultAnswer->id ?>) {
                                options += '<option value="' + key + '" id="' + key + '" class="optionQ" selected>' + data['answers'][key] + '</option>\n';
                            } else
                                options += '<option value="' + key + '" id="' + key + '" class="optionQ">' + data['answers'][key] + '</option>\n';
                        });
                        $('.answerr').remove();
                        $('.answers').append('        <select class="form-control btn answerr" style="width: 340px" onchange="action=this.value">' + options + '</select>');
                        $('.answerr').on('click', function () {
                            var answer_id = $(this).children("option:selected").val();
                            window.location.href = "http://localhost:8000/polls/<?= $poll->id ?>/report3/" + question_id + "/" + answer_id;
                        });
                    } else if (data['type'] == 'numberInput') {
                        $('.answerr').remove();
                        $('.answers').append("<div class='answerr'><div class='multi-range' data-lbound='" + data['min'] + "' data-ubound='" + data['max'] + "'>\n" +
                            "            <hr />\n" +
                            "            <input type='range' id='rangeMin'\n" +
                            "                   min='" + data['min'] + "' max='" + data['max'] + "' step='" + data['step'] + "' value='" + data['min'] + "'\n" +
                            "                   oninput='this.parentNode.dataset.lbound=this.value;'\n" +
                            "            />\n" +
                            "            <input type='range' id='rangeMax'\n" +
                            "                   min='" + data['min'] + "' max='" + data['max'] + "' step='" + data['step'] + "' value='" + data['max'] + "'\n" +
                            "                   oninput='this.parentNode.dataset.ubound=this.value;'\n" +
                            "            />\n" +
                            "        </div>" +
                            "<button type='button' id='rangeBtn' class='btn btn-secondary'>OK</button> </div>");
                        rangeBtnListener();

                    } else if (data['type'] == 'input') {
                        $('.answerr').remove();
                    } else if (data['type'] == 'map') {
                        $('.reportChild').remove();
                        $('.answerr').remove();
                        $('.answers').append('<div class="map" id="map"></div>');

                        var map;
                        var myLatlng = new google.maps.LatLng(-25.363882, 131.044922);
                        var geocoder = new google.maps.Geocoder();
                        var array = document.getElementById('map');
                        var coordinates = data['coordinates'];

                        map = new google.maps.Map(array, {
                            center: {lat: coordinates[0][0], lng: coordinates[0][1]},
                            zoom: 3,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        });
                        var addresses = [];
                        for (var i = 0; i < coordinates.length; i++) {
                            marker = new google.maps.Marker({
                                map: map,
                                position: {lat: coordinates[i][0], lng: coordinates[i][1]},
                            });
                            geocoder.geocode({'latLng': {lat: coordinates[i][0], lng: coordinates[i][1], addresses}},function(results, status, addresses) {
                                if (results[0]) {
                                    var t = results[0].formatted_address;
                                   addresses.push(t);
                                }
                            });

                        }
                        console.log(geocoder);
                        showCity(addresses);

                        $('.report').append('<h2>Count of respondents: '+coordinates.length+'</h2>');
                    }


                },
                error: function (err) {
                    console.log('fail');
                },
            });
        }
        function showCity(addresses) {
            $('.reportChild').remove();
            var report = '';
            var arr = new Set(addresses);
            console.log(arr);
            for (var i = 0; i < addresses.length; i++ ) {

            }
            addresses.forEach(function (value) {
console.log(value);

               report += '                    <tr style="border-top: 5px solid #ddd5d0;">\n' +
                        '                        <td style="font-size: 30px">' + value + '</td>\n' +
                        '                        <td style="font-size: 40px">' + value + '</td>\n' +
                        '                    </tr>\n';
            });
            console.log(report);
            $('.report').append(' <div class="reportChild">\n<h1>REPORT</h1>\n' +
                '        <hr>\n' +
                '        <table class="table table-bordered">\n' +
                '            <thead>\n' +
                '            <tr style="    background-color: #ddd5d0;\n' +
                '    font-size: 20px;">\n' +
                '                <th scope="col">Place</th>\n' +
                '                <th scope="col">Count</th>\n' +
                '            </tr>\n' +
                '            </thead>\n' +
                '            <tbody>\n' +
                report +
                '            </tbody>\n' +
                '        </table>\n' +
                '        <hr></div>');
        }
        function rangeBtnListener() {
            $('#rangeBtn').on('click', function () {
                var question_id = $('.question').children("option:selected").val();
                var min = $('#rangeMin').val();
                var max = $('#rangeMax').val();
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('report3.range') }}",
                    dataType: 'JSON',
                    data: {
                        "_method": 'POST',
                        "_token": token,
                        "poll": <?= $poll ?>,
                        "question_id": question_id,
                        "min": min,
                        "max": max,
                    },
                    headers: {

                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')

                    },
                    success: function (data) {
                        console.log(data);
                        showReport(data);
                    },
                    error: function (err) {
                    },

                })
            });
        }

        function showReport(data) {
            $('.reportChild').remove();
            var report = '';
            Object.keys(data['reports']).forEach(function (key) {
                if (data['prev'] == data['reports'][key]['Qid'])
                    report += '                    <tr>\n';
                else
                    report += '                    <tr style="border-top: 5px solid #ddd5d0;">\n' +
                        '                        <td style="font-size: 30px">' + data['reports'][key]['Question'] + '</td>\n' +
                        '                        <td style="font-size: 40px">' + data['reports'][key]['Answer'] + '</td>\n' +
                        '                        <td style="font-size: 40px">' + data['reports'][key]['Count'] + '</td>\n' +
                        '                        <td style="font-size: 30px"><b>' + data['reports'][key]['Qid'] + ' %</b></td>\n' +
                        '                    </tr>\n';
                data['prev'] = data['Qid'];
            });
            $('.report').append(' <div class="reportChild">\n<h1>REPORT</h1>\n' +
                '        <hr>\n' +
                '        <h2>' + data['question_title'] + '</h2>\n' +
                '        <h3>Answer: ' + data['answer_title'] + '</h3>\n' +
                '        <h2>Count of respondents: ' + data['anonCount'] + '</h2>\n' +
                '        <table class="table table-bordered">\n' +
                '            <thead>\n' +
                '            <tr style="    background-color: #ddd5d0;\n' +
                '    font-size: 20px;">\n' +
                '                <th scope="col">Question</th>\n' +
                '                <th scope="col">Answer</th>\n' +
                '                <th scope="col">Count</th>\n' +
                '                <th scope="col">Percent</th>\n' +
                '            </tr>\n' +
                '            </thead>\n' +
                '            <tbody>\n' +
                report +
                '            </tbody>\n' +
                '        </table>\n' +
                '        <hr></div>');
        }
    </script>


@stop