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




        .banner {
            position: relative;
            width: 100%;

            margin: auto;
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

            /* th,
                                        td {
                                            border: 1px solid #1da0b4;
                                            padding: 4px 2px;
                                            text-align: center;
                                        }

                                        th {
                                            font-size: 12px
                                        } */
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
            border-collapse: separate;
            border-spacing: 3px;
            font-size: 18px;
        }

        #dataTable th,
        #dataTable td {
            border: 2px solid #FFD700;
            padding: 10px;
            text-align: center;
        }

        #dataTable thead th {
            background-color: #808080;
            color: white;
            font-size: 20px;
            border-bottom: 4px solid #FFD700;
        }

        /* tbody th:nth-child(even) {
                        background-color: #008001;
                    }

                    tbody th:nth-child(odd) {
                        background-color: #0000FF;
                    }

                    tbody td:nth-child(odd) {
                        background-color: #fea500;
                    }


                    tbody td:nth-child(odd) {
                        background-color: #FFFF;
                    } */



        .time-column {
            color: white;
        }

        @media (max-width: 600px) {
            #dataTable {
                font-size: 14px;
            }

            #dataTable th {
                font-size: 16px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="banner" style="background-color: #8f3efb">
        {{-- <img src="{{ asset('banner.jpeg') }}" alt="Banner Image" class="banner-image"> --}}


        <marquee width="100%" direction="left" height="100px" style="color: white;font-weight:bolder">WELCOME TO DEAR GOA
            STAR247</marquee>

        <p id="draw-time-info" class="overlay-text">Next Draw Time: | Remaining Time: </p>
    </div>


    <div class="container">
        <div class="date-selector">
            <input type="date" class="date-input" id="selectedDate"
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
                        <th>Time</th>
                        <th>गोल्डन लक्ष्मी</th>
                        <th>शुभ लक्ष्मी</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Table data will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.querySelector('.date-input');
            const refreshBtn = document.querySelector('.refresh-btn');
            const dateDisplay = document.querySelector('.date-display');
            const loaderContainer = document.getElementById('loaderContainer');
            const dataTable = document.getElementById('dataTable');
            const tableBody = document.getElementById('tableBody');
            const selectedDate = document.getElementById('selectedDate');
            const installIcon = document.querySelector('.install-icon');




            function updateDate() {
                const selectedDate = new Date(dateInput.value);
                const formattedDate = selectedDate.toLocaleDateString('en-GB').split('/').join('-');
                dateDisplay.textContent = `Date: ${formattedDate}`;
            }

            function showLoader() {
                loaderContainer.style.display = 'flex';
                dataTable.style.display = 'none';
            }

            function hideLoader() {
                loaderContainer.style.display = 'none';
                dataTable.style.display = 'table';
            }

            function processDraws(drawsData) {
                return Array.isArray(drawsData) ? drawsData :
                    (typeof drawsData === 'object' && drawsData !== null) ? Object.values(drawsData) : [];
            }

            function formatNumber(num) {
                return num;
                return num < 10 ? '0' + num : num;
            }

            function updateTable(draws) {
                const processedDraws = processDraws(draws);

                // Populate the table with rows
                tableBody.innerHTML = processedDraws.length > 0 ?
                    processedDraws.map((draw, index) => `
            <tr>
                <th>${draw.draw_time}</th>
                <td class='samecolor'>${formatNumber(draw.a)}${formatNumber(draw.b)}</td>
                <td class='samecolor'>${formatNumber(draw.c)}${formatNumber(draw.d)}</td>
            </tr>
        `).join('') :
                    '<tr><td colspan="3">No data available</td></tr>';

                // Apply styles to the table after the rows are inserted
                const rows = tableBody.querySelectorAll('tr');

                rows.forEach((row, rowIndex) => {
                    const th = row.querySelector('th');
                    const tds = row.querySelectorAll('td');

                    // Apply color to <th> elements
                    th.style.backgroundColor = rowIndex % 2 === 0 ? '#008001' : '#0000FF';
                    th.style.color = rowIndex % 2 === 0 ? '#000000' : '#FFFFFF';

                    // Determine the background color for 'samecolor' cells based on row index
                    const sameColorBg = rowIndex % 2 === 0 ? '#fea500' : '#FFFFFF';

                    // Apply color to <td> elements
                    tds.forEach(td => {
                        if (td.classList.contains('samecolor')) {
                            td.style.backgroundColor = sameColorBg;
                        }
                    });
                });
            }

            function fetchDraws(date) {
                showLoader();

                // Create a promise that resolves after 2 seconds
                const delay = new Promise(resolve => setTimeout(resolve, 2000));

                // Fetch data
                const fetchData = fetch('/get-draws?date=' + date)
                    .then(response => response.json());

                // Wait for both the delay and the fetch to complete
                Promise.all([delay, fetchData])
                    .then(([_, data]) => {
                        hideLoader();
                        updateTable(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        hideLoader();
                        alert('An error occurred while fetching data.');
                    });
            }

            dateInput.addEventListener('change', updateDate);
            refreshBtn.addEventListener('click', () => location.reload());
            selectedDate.addEventListener('change', e => fetchDraws(e.target.value));
            // installIcon.addEventListener('click', () => console.log('Install icon clicked'));

            // Initial load
            const today = new Date().toISOString().split('T')[0];
            selectedDate.value = today;
            fetchDraws(today);
        });

        // PWA installation
        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
        });






        function updateNextDrawTime() {
            const currentTime = new Date();
            const drawTimes = [];

            // Generate all draw times for the day
            for (let hour = 9; hour <= 21; hour++) {
                drawTimes.push(new Date(currentTime.getFullYear(), currentTime.getMonth(), currentTime.getDate(), hour, 0,
                    0, 0));
                drawTimes.push(new Date(currentTime.getFullYear(), currentTime.getMonth(), currentTime.getDate(), hour, 30,
                    0, 0));
            }

            // Find the next draw time
            // console.log(drawTimes);
            let nextDrawTime = drawTimes.find(time => time > currentTime);

            // If no draw time found today, set it to the first draw time tomorrow
            if (!nextDrawTime) {
                nextDrawTime = new Date(currentTime.getFullYear(), currentTime.getMonth(), currentTime.getDate() + 1, 9, 0,
                    0, 0);
            }

            const nextDrawTimeString = nextDrawTime.toLocaleTimeString([], {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            updateRemainingTime(nextDrawTime, nextDrawTimeString);

            setTimeout(updateNextDrawTime, 60000); // Refresh every minute
        }

        function updateRemainingTime(nextDrawTime, nextDrawTimeString) {
            const currentTime = new Date();
            const timeDifference = nextDrawTime - currentTime;

            const hours = Math.floor(timeDifference / (1000 * 60 * 60));
            const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            const remainingTimeString = `${padZero(hours)} : ${padZero(minutes)} : ${padZero(seconds)}`;

            document.getElementById('draw-time-info').innerText =
                `Next Draw Time: ${nextDrawTimeString} | ${remainingTimeString}`;

            // Update remaining time every second
            setTimeout(() => updateRemainingTime(nextDrawTime, nextDrawTimeString), 1000);
        }

        function padZero(number) {
            return number < 10 ? '0' + number : number;
        }

        // Initialize the function on page load
        document.addEventListener('DOMContentLoaded', updateNextDrawTime);
    </script>
    @yield('scripts')
@endsection
