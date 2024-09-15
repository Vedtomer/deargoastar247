@extends('website.layouts.app')

@section('styles')
    <style>
        .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .refresh-btn {
            margin-left: 10px;
        }

        .date-display {
            text-align: center;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .banner {
            position: relative;
            width: 100%;

            margin: auto;
        }

        .banner-image {
            width: 100%;

            height: 75vh;
            display: block;
        }

        .overlay-text {
            position: absolute;
            bottom: 10px;
            /* Adjust as needed */
            left: 50%;
            transform: translateX(-50%);
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent background for better readability */
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 16px;
            /* Adjust as needed */
            font-weight: bold;
        }



        @media (max-width: 768px) {


            .overlay-text {
                font-size: 13px;
                text-align: center
            }

            .banner-image {
                height: 50vh;

            }

            th,
            td {
                border: 1px solid #1da0b4;
                padding: 4px 2px;
                text-align: center;
            }

            th {
                font-size: 12px
            }
        }

        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
            display: flex;
            z-index: 99999999999;
            justify-content: center;
            align-items: center;
        }

        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            background: #fff;
            border-radius: 10px;
            width: 300px;
            position: relative;
            transition: all 0.3s ease-in-out;
            text-align: center;
            padding: 20px;
        }

        .popup .app-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }

        .popup h3 {
            margin: 10px 0;
            font-size: 1.5em;
            color: #333;
        }

        .popup p {
            margin: 10px 0;
            font-size: 1em;
            color: #666;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .popup button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            flex-grow: 1;
            margin: 0 5px;
        }

        .popup #installBtn {
            background-color: black;
            color: white;
        }

        .popup #cancelBtn {
            /* background: none; */
            color: black;
        }

        @media screen and (max-width: 700px) {
            .popup {
                width: 70%;
            }
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        #dataTable {
            width: 100%;
            border-collapse: collapse;
        }

        @media screen and (max-width: 600px) {
            .table-container {
                width: 100%;
                overflow-x: auto;
            }
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background-color: #2905ff;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .date-selector {
            display: flex;
            align-items: center;
        }

        .date-input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #0056b3;
            border-radius: 4px;
            margin-right: 10px;
        }

        .refresh-btn {
            cursor: pointer;
            margin-left: 10px;
        }

        .install-icon {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="banner" style="background-color: #8f3efb">
        {{-- <img src="{{ asset('banner.jpeg') }}" alt="Banner Image" class="banner-image"> --}}


        <marquee width="100%" direction="left" height="100px" style="color: white;font-weight:bolder">WELCOME TO DEAR GOA STAR247</marquee>

        <p id="draw-time-info" class="overlay-text">Next Draw Time: | Remaining Time: </p>
    </div>


    <div class="container">
        <div class="date-selector">
            <input type="date" class="date-input" id="selectedDate" value="{{ request()->input('date', date('Y-m-d')) }}">
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
                            stroke="#1da0b4" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </a>

        </div>
    </div>


    <div class="content">
        <div class="loader-container" id="loaderContainer" style="display: flex;justify-content:center">
            <div class="loader" id="loader">
                <svg width="80px" height="80px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                    <circle cx="50" cy="50" fill="none" stroke="#1fa6b9" stroke-width="10" r="35"
                        stroke-dasharray="164.93361431346415 56.97787143782138">
                        <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite"
                            dur="0.4524886877828056s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                    </circle>
                </svg>
            </div>
        </div>
        <div class="table-container">
            <table id="dataTable" style="display: none;">
                <thead>
                    <tr>
                        <th>TIME</th>
                        <th>A</th>
                        <th>B</th>
                        <th>A</th>
                        <th>B</th>

                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Table data will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </div>
@endsection
