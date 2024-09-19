<script>
    function updateTime() {
        const now = new Date();
        let hours = now.getHours();
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');

        // Determine AM or PM
        const ampm = hours >= 12 ? 'PM' : 'AM';

        // Convert to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // If hours = 0, make it 12 (for 12 AM)
        const formattedHours = hours.toString().padStart(2, '0');

        // Format time as hh:mm:ss AM/PM
        const formattedTime = formattedHours + ':' + minutes + ':' + seconds + ' ' + ampm;

        // Update the time in the span
        document.getElementById('currentTime').textContent = formattedTime;
    }

    // Update the time every second
    setInterval(updateTime, 1000);

    // Initial call to display time immediately
    updateTime();


    function isToday(date) {
        const today = new Date();
        return date.getDate() === today.getDate() &&
            date.getMonth() === today.getMonth() &&
            date.getFullYear() === today.getFullYear();
    }

    function isBeforeNineThirtyPM() {
        const now = new Date();
        const nineThirtyPM = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 21, 30, 0);
        return now < nineThirtyPM;
    }


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
                <td class='samecolor2'>${formatNumber(draw.c)}${formatNumber(draw.d)}</td>
            </tr>
        `).join('') :
                '<tr><td colspan="3">No data available</td></tr>';

            // Apply styles to the table after the rows are inserted
            const rows = tableBody.querySelectorAll('tr');

            rows.forEach((row, rowIndex) => {
                const th = row.querySelector('th');
                const tds = row.querySelectorAll('td');

                // Apply color to <th> elements
                th.style.backgroundColor = rowIndex % 2 === 0 ? '#2905ff' : '#2905ff';
                th.style.color = rowIndex % 2 === 0 ? '#FFFFFF' : '#FFFFFF';

                // Determine the background color for 'samecolor' cells based on row index
                const sameColorBg = rowIndex % 2 === 0 ? '#fea500' : '#fea500';
                const sameColorBg2 = rowIndex % 2 === 0 ? '#2905ff' : '#2905ff';

                // Apply color to <td> elements
                tds.forEach(td => {
                    if (td.classList.contains('samecolor')) {
                        td.style.backgroundColor = sameColorBg;
                    }
                });

                tds.forEach(td => {
                    if (td.classList.contains('samecolor2')) {
                        td.style.backgroundColor = sameColorBg2;
                        td.style.color = rowIndex % 2 === 0 ? '#FFFFFF' : '#FFFFFF';
                    }
                });
            });


            if (processedDraws.length > 0 && isToday(new Date(selectedDate.value)) && isBeforeNineThirtyPM()) {
                const latestDraw = processedDraws[processedDraws.length - 1]; // Get the last result
                const firstDraw = processedDraws[0]; // Get the first result
                // Set the latest draw data in the respective spans
                document.getElementById('result_time').textContent = firstDraw.draw_time;
                document.getElementById('latest_result1').textContent =
                    `${formatNumber(firstDraw.a)}${formatNumber(firstDraw.b)}`;
                document.getElementById('latest_result2').textContent =
                    `${formatNumber(firstDraw.c)}${formatNumber(firstDraw.d)}`;
            } else {
                // If no draws are available, set default text
                document.getElementById('result_time').textContent = '-';
                document.getElementById('latest_result1').textContent = '-';
                document.getElementById('latest_result2').textContent = '-';
            }
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
                    //alert('An error occurred while fetching data.');
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
</script>


<script>
    const drawTimes = [
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

    function updateNextDrawTime() {
        const currentTime = new Date();
        let nextDrawTime = getNextDrawTime(currentTime);

        const nextDrawTimeString = nextDrawTime.toLocaleTimeString([], {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });

        updateRemainingTime(nextDrawTime, nextDrawTimeString);

        // Schedule the next update
        setTimeout(updateNextDrawTime, 60000); // Update every minute
    }

    function getNextDrawTime(currentTime) {
        const currentHour = currentTime.getHours();
        const currentMinute = currentTime.getMinutes();

        // If it's past 9 PM, set next draw time to 9 AM tomorrow
        if (currentHour >= 21) {
            return new Date(currentTime.getFullYear(), currentTime.getMonth(), currentTime.getDate() + 1, 9, 0, 0, 0);
        }

        // Find the next draw time
        for (let time of drawTimes) {
            const [hours, minutes, period] = time.match(/(\d+):(\d+) (\w+)/).slice(1);
            let drawHour = parseInt(hours);
            const drawMinute = parseInt(minutes);

            if (period === 'PM' && drawHour !== 12) {
                drawHour += 12;
            }
            if (period === 'AM' && drawHour === 12) {
                drawHour = 0;
            }

            if (drawHour > currentHour || (drawHour === currentHour && drawMinute > currentMinute)) {
                return new Date(currentTime.getFullYear(), currentTime.getMonth(), currentTime.getDate(), drawHour,
                    drawMinute, 0, 0);
            }
        }

        // If no time found (shouldn't happen with the given range), return 9 AM tomorrow
        return new Date(currentTime.getFullYear(), currentTime.getMonth(), currentTime.getDate() + 1, 9, 0, 0, 0);
    }

    function updateRemainingTime(nextDrawTime, nextDrawTimeString) {
        const currentTime = new Date();
        const timeDifference = nextDrawTime - currentTime;

        const hours = Math.floor(timeDifference / (1000 * 60 * 60));
        const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

        const remainingTimeString = `${padZero(hours)}:${padZero(minutes)}:${padZero(seconds)}`;

        // Update the next draw time display
        const nextDrawTimeElement = document.getElementById('NextDrawTime');
        if (nextDrawTimeElement) {
            nextDrawTimeElement.innerText = `: ${nextDrawTimeString}`;
        }

        // Update the remaining time display
        const remainingTimeElement = document.getElementById('RemainingTime');
        if (remainingTimeElement) {
            remainingTimeElement.innerText = `: ${remainingTimeString}`;
        }

        // Update remaining time every second
        setTimeout(() => updateRemainingTime(nextDrawTime, nextDrawTimeString), 1000);
    }

    // Helper function to pad single digit numbers with a leading zero
    function padZero(num) {
        return num.toString().padStart(2, '0');
    }

    // Initialize the function on page load
    document.addEventListener('DOMContentLoaded', updateNextDrawTime);
</script>
