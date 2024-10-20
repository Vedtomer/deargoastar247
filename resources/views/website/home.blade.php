@extends('website.layouts.app')

@section('styles')
    <style>
        .refresh-btn {
            margin-left: 10px;
        }

        .date-display {
            text-align: center;
            margin: 20px 0;
        }


        .date-selector {
            display: flex;
            align-items: center;
        }

        .date-input {
            padding: 5px;
            font-size: 16px;
            border: 1px solid #0056b3;
            border-radius: 4px;
            /* margin-right: 10px; */
        }

        .refresh-btn {
            cursor: pointer;
            margin-left: 10px;
        }
    </style>

    <style>
        .table-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            overflow-x: auto;
        }

        #dataTable {
            width: 100%;
            /* border-collapse: separate;
            border-spacing: 3px; */
            font-size: 18px;
        }

        #dataTable th,
        #dataTable td {
            /* border: 2px solid #FFD700; */
            padding: 10px;
            text-align: center;
        }

        #dataTable thead th {
            background-color: #004C99;;
            color: white;
            font-size: 20px;
            /* border-bottom: 4px solid #FFD700; */
        }

        td {
            font-size: 20px;
            font-weight: bolder;
        }

        .time-column {
            color: white;
        }

        @media (max-width: 600px) {
            #dataTable {
                font-size: 14px;
            }

            #dataTable th {
                font-size: large;
            }

            #dataTable td {
                font-size: xx-large !important;
            }

        }

        .btn-g20 {
            background: #a41c1c;
            color: #fff;
            padding: 5px 10px;
            font-size: 14px;
            font-family: Arial;
        }
    </style>
@endsection

@section('content')
    <div id="title_grad" style="background-image: linear-gradient(#7256ff, #923afa);">

        <marquee id="a" scrollamount="3" onmouseover="this.stop();" onmouseout="this.start();"
            style=" font-family:Verdana; font-weight: bold;    background-color: seashell; color: #E13300; margin-top: 5px; padding-bottom:2px; ">

            WELCOME TO DEAR GOA STAR 02269710251

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
                                style="">
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




        <a class="btn btn-xs btn-g20" style="z-index: 0" href="/login">Login</a>


        <a class="btn btn-xs btn-g20" href="/" style="z-index: 0">Day Results</a>

        <a class="btn btn-g20" href="/month-result" style="z-index: 0">Month Results</a>

        <br><br>



        <span style="font-family: Arial; color: #990073; font-size: x-large  ">Live Draw Time : <b><span
                    id="NextDrawTime"></span></b> </span>

        <span style="font-family: Arial; color: #990073 "> <br> Time Remaing :<b> <span
                    id="RemainingTime"></span></b></span>



    </div>


    <div class="text-center">
        <h3>RESULTS</h3>
        Date: <input type="date" style="width: 130px" name="selectDate" data-date="" data-date-format="DD MM YYYY"
            value="2024-09-09" class="hasDatepicker date-input" id="selectedDate"
            value="{{ request()->input('date', date('Y-m-d')) }}">
        <a class="refresh-btn" onclick="location.reload();" title="refresh">
            <svg width="32px" height="32px" viewBox="-2.4 -2.4 28.80 28.80" fill="none"
                xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                <g id="SVGRepo_bgCarrier" stroke-width="0">
                    <rect x="-2.4" y="-2.4" width="28.80" height="28.80" rx="14.4" fill="#fff" strokewidth="0">
                    </rect>
                </g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path
                        d="M18.6091 5.89092L15.5 9H21.5V3L18.6091 5.89092ZM18.6091 5.89092C16.965 4.1131 14.6125 3 12 3C7.36745 3 3.55237 6.50005 3.05493 11M5.39092 18.1091L2.5 21V15H8.5L5.39092 18.1091ZM5.39092 18.1091C7.03504 19.8869 9.38753 21 12 21C16.6326 21 20.4476 17.5 20.9451 13"
                        stroke="#2905ff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path>
                </g>
            </svg>
        </a>
    </div>



    <div class="content" style="margin-top: 30px">
        <div class="loader-container" id="loaderContainer" style="display: flex;justify-content:center">
            <div class="loader" id="loader">
                <svg width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <circle cx="50" cy="50" fill="none" stroke="#2905ff" stroke-width="10" r="35"
                        stroke-dasharray="164.93361431346415 56.97787143782138">
                        <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite"
                            dur="0.4524886877828056s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                    </circle>
                </svg>
            </div>
        </div>

        <div class="table-container" style="padding-top: auto; font-family: sans-serif; background-color:  #004C99;">
            <table id="dataTable" style="display: none;">
                <thead>
                    <tr>
                        <th>Time</th>
                        <th style="  background-color: #2056E6;">गोल्डन लक्ष्मी</th>
                        <th>शुभ लक्ष्मी</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Table data will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </div>





