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


        const rowColors = [
            '#FFB3BA', '#BAFFC9', '#BAE1FF', '#FFFFBA', '#FFDFBA',
            '#E0BBE4', '#D4F0F0', '#FFC6FF', '#DAEAF6', '#C8E7ED'
        ];

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
            tableBody.innerHTML = processedDraws.length > 0 ?
                processedDraws.map((draw, index) => `
            <tr style="background-color: ${rowColors[index % rowColors.length]}">
                <th>${draw.draw_time}</th>
                <td>${formatNumber(draw.a)}</td>
                <td>${formatNumber(draw.b)}</td>
                <td>${formatNumber(draw.c)}</td>
                <td>${formatNumber(draw.d)}</td>

            </tr>`).join('') :
                '<tr><td colspan="11">No data available</td></tr>';
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

    // document.getElementById('installBtn').addEventListener('click', () => {
    //     closePopup();
    //     if (deferredPrompt) {
    //         deferredPrompt.prompt();
    //         deferredPrompt.userChoice.then((choiceResult) => {
    //             console.log(choiceResult.outcome === 'accepted' ?
    //                 'User accepted the install prompt' :
    //                 'User dismissed the install prompt'
    //             );
    //             deferredPrompt = null;
    //         });
    //     }
    // });

    function openPopup() {
        const popup = document.getElementById('popup1');
        popup.style.visibility = 'visible';
        popup.style.opacity = 1;
    }

    function closePopup() {
        const popup = document.getElementById('popup1');
        popup.style.visibility = 'hidden';
        popup.style.opacity = 0;
    }




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
