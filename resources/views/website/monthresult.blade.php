@extends('website.layouts.app')

@section('styles')
    <style>

table{
    font-family: sans-serif;
    color: yellow;
    font-size: 15px;
    font-weight: bold;
    background-color: #05255c;
    border: 2px solid yellow;
    width: 100%;
}


td.result-slot {
    font-family: sans-serif; color: yellow; font-size: 15px; font-weight: bold; background-color: #05255c;border:2px solid yellow;
}

       th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #003366;
            color: white;
        }

        .result-slot {
            background-color: #003366;
            color: white;
        }


        .btn-g20 {
            background: #a41c1c;
            color: #fff;
            padding: 5px 10px;
            font-size: 14px;
            font-family: Arial;
        }

        .form-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }


    </style>

@endsection

@section('content')
    <div id="title_grad" style="background-image: linear-gradient(#7256ff, #923afa);">

        <marquee id="a" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();"
            style=" font-family:Verdana; font-weight: bold;    background-color: seashell; color: #E13300; margin-top: 5px; padding-bottom:2px; ">

            WELCOME TO DEAR GOA STAR

        </marquee>



        <header class="navigations fixed-tops center">

            <nav class="navbar navbar-expand-lg navbar-darks center">

                {{-- <input type="hidden" id="nxtDrTime" name="nxtDrTime" value="Sep 17, 2024 10:00:00"> --}}

                <div style="text-align: center;  width: 100%">

                    <a class="navbar-brand font-tertiaryS h4 " href="/rashi">
                        <img src="{{ asset('images/logo.webp') }}" style="width: 30%;" alt="Dear Rajashree Goa Star">
                        <span style="color: white"><img src="{{ asset('images/logo2.png') }}" style="width: 35%;"
                                alt=""></span>
                        <span style="color: white"><img src="{{ asset('images/logo.webp') }}" style="width: 30%;"
                                alt=""></span>
                    </a>

                </div>

                <div class="rounded"
                    style="text-align: center;  width: 100%; color: blue; font-weight: bold; text-align: center; display: inline-block;padding:5px">

                    <div class="rounded" style="border-style: thick; border-color: red; width: 100%">

                        <table width="100%">

                            <tbody>
                                <tr
                                    style="border-top-width: 2px; border-top-color: #804000; border-top-style: ridge; border-bottom-width: 2px; border-bottom-color: #804000; border-bottom-style: ridge;">

                                    <td align="left">
                                        <span style="font-size: medium; color: #fed22f">Time:
                                            <strong><span style="color: #FFFFFF" id="currentTime"></span></strong>
                                        </span>
                                    </td>

                                    <td align="right" style="color: #FFFFFF">
                                        <span style="color: #fed22f; font-size: medium">Date: </span>
                                        <span id="todays_date">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</span>
                                    </td>

                                </tr>

                            </tbody>
                        </table>

                    </div>


                </div>
            </nav>

        </header>

    </div>



    <div align="center">

        <article class="card shadow col-lg-4 " style="text-align: center; padding-top: 5px; text-align: center;">

            <div class="rounded "
                style="padding-top: auto; font-family: sans-serif; background-color: #2905ff; width: 100%">

                <table style="width: 100%; text-align: center">

                    <tbody>
                        <tr
                            style="border-bottom-width: 2px; border-bottom-color: #99CCFF; border-bottom-style: ridge; color: yellow">

                            <td>
                                <div class=""
                                    style="font-size: x-large;   font-family: sans-serif;font-weight:bolder">Result Slot
                                </div>
                            </td>

                            <td
                                style=" font-family: sans-serif;  font-size: 12px; font-weight: bold; background-color: #ef8010;">
                                गोल्डन<br>लक्ष्मी</td>

                            <td
                                style=" font-family: sans-serif;  font-size: 12px; font-weight: bold; background-color:  #2905ff;">
                                शुभ<br>लक्ष्मी</td>
                        </tr>

                        <tr>

                            <td
                                style=" font-family: sans-serif; color: white; font-size: xx-large; font-weight: bold; background-color: #2905ff;">
                                <span id="result_time" style="" class="text-uppercase"></span>
                            </td>

                            <td
                                style=" font-family: sans-serif; color: white; font-size: xx-large; font-weight: bold; background-color: #ef8010;">
                                <span id="latest_result1">-</span>
                            </td>

                            <td
                                style=" font-family: sans-serif; color: white; font-size: xx-large; font-weight: bold; background-color: #2905ff;">
                                <span id="latest_result2">-</span>
                            </td>





                        </tr>

                    </tbody>
                </table>

            </div>

        </article>

    </div>


    <div style="width: 100%; text-align: center; padding-top: 10px; z-index: -5 " class="center">



        <a class="btn btn-xs btn-g20" style="z-index: 0" href="/">Home</a>
        <a class="btn btn-xs btn-g20" style="z-index: 0" href="#">Login</a>


        <a class="btn btn-xs btn-g20" href="/" style="z-index: 0">Day Results</a>

        <a class="btn btn-g20" href="#" style="z-index: 0">Month Results</a>

        <br><br>



        <span style="font-family: Arial; color: #990073; font-size: x-large  ">Live Draw Time : <b><span
                    id="NextDrawTime"></span></b> </span>

        <span style="font-family: Arial; color: #990073 "> <br> Time Remaing :<b> <span
                    id="RemainingTime"></span></b></span>



    </div>



    <div class="container">
        <div class="form-container">
            <h1 class="text-center mb-4">RESULTS</h1>

            <form id="resultsForm">
                <div class="mb-3">
                    <label for="month" class="form-label">Select Month-Year:</label>
                    <div class="row">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <select id="month" name="month" class="form-select">
                                @php
                                    $currentMonth = date('n');
                                    for ($m = 1; $m <= 12; $m++) {
                                        $monthName = date('F', mktime(0, 0, 0, $m, 1));
                                        $selected = ($m == $currentMonth) ? 'selected' : '';
                                @endphp
                                <option value="{{ $m }}" {{ $selected }}>{{ $monthName }}</option>
                                @php
                                    }
                                @endphp
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="year" name="year" class="form-select">
                                @php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 5; // Adjust as needed
                                    $endYear = $currentYear + 5;   // Adjust as needed
                                    for ($y = $startYear; $y <= $endYear; $y++) {
                                        $selected = ($y == $currentYear) ? 'selected' : '';
                                @endphp
                                <option value="{{ $y }}" {{ $selected }}>{{ $y }}</option>
                                @php
                                    }
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="game" class="form-label">Select Game:</label>
                    <select id="game" name="game" class="form-select">
                        <option value="1">गोल्डन लक्ष्मी</option>
                        <option value="2">शुभ लक्ष्मी</option>
                        <!-- Add other games as needed -->
                    </select>
                </div>

                <div class="d-grid">
                    <button type="button" id="showResults" class="btn btn-primary btn-lg">Show Results</button>
                </div>
            </form>
        </div>
    </div>



    <div class="container">

    <div id="resultsTable"></div>
        </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#showResults').click(function() {
                var month = $('#month').val();
                var year = $('#year').val();
                var game = $('#game').val();

                $.ajax({
                    url: '/get-monthly-draws',
                    method: 'GET',
                    data: {
                        month: month,
                        year: year,
                        game: game
                    },
                    success: function(response) {
                        var tableHtml = '<table>';
                        tableHtml += '<tr><th style=" font-family: sans-serif; color: yellow; font-size: 15px; font-weight: bold; background-color: #05255c;border:2px solid yellow;">Result Slot</th>';
                        for (var i = 1; i <= 31; i++) {
                            tableHtml += '<th>' + i + '</th>';
                        }
                        tableHtml += '</tr>';

                        var timeSlots = [
                            '09:00 AM', '09:15 AM', '09:30 AM', '09:45 AM',
                            '10:00 AM', '10:15 AM', '10:30 AM', '10:45 AM',
                            '11:00 AM', '11:15 AM', '11:30 AM', '11:45 AM',
                            '12:00 PM', '12:15 PM', '12:30 PM', '12:45 PM',
                            '01:00 PM', '01:15 PM', '01:30 PM', '01:45 PM',
                            '02:00 PM', '02:15 PM', '02:30 PM', '02:45 PM',
                            '03:00 PM', '03:15 PM', '03:30 PM', '03:45 PM',
                            '04:00 PM', '04:15 PM', '04:30 PM', '04:45 PM',
                            '05:00 PM', '05:15 PM', '05:30 PM', '05:45 PM',
                            '06:00 PM', '06:15 PM', '06:30 PM', '06:45 PM',
                            '07:00 PM', '07:15 PM', '07:30 PM', '07:45 PM',
                            '08:00 PM', '08:15 PM', '08:30 PM', '08:45 PM',
                            '09:00 PM'
                        ];

                        timeSlots.forEach(function(slot) {
                            tableHtml += '<tr><td class="result-slot">' + slot +
                            '</td>';
                            for (var day = 1; day <= 31; day++) {
                                var draw = response.find(d => d.draw_time === slot &&
                                    new Date(d.date).getDate() === day);
                                tableHtml += '<td style=" font-family: sans-serif; color: white; font-size: 13px; font-weight: bold; background-color: #2056E6;border:2px solid yellow;">' + (draw ? draw.result : '-') +
                                    '</td>';
                            }
                            tableHtml += '</tr>';
                        });

                        tableHtml += '</table>';
                        $('#resultsTable').html(tableHtml);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching results:", error);
                        $('#resultsTable').html(
                            '<p>Error fetching results. Please try again.</p>');
                    }
                });
            });
        });
    </script>

@endsection
