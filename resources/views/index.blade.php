@extends('layout.layout')
@section('content')
<div class="content-wrapper">

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col">
                <div class="row">
                    <h2>
                        <span style="color:#1A4980">Selamat</span>
                        <span style="color:#027CCC" id="greetings">Pagi</span>
                    </h2>
                </div>
                <div class="row">
                    <h3 style="color:#1A4980">{{ $user->user_data->last_name }}</h3>
                </div>
            </div>
            <div class="col text-end">
                <div class="row">
                    <h2 style="color:#1A4980" id="dateNow">Senin 3 july</h2>
                </div>
                <div class="row">
                    <h3 style="color:#027CCC" id="timeNow">10:30</h3>
                </div>
            </div>
        </div>
        <div class="card py-4">
            <div class="container">

            </div>
        </div>
    </div>

    <div class="content-backdrop fade"></div>
    <footer class="content-footer footer bg-footer-theme">
        {{-- <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                <a href="https://admin.sucofindobandung.com/public/storage/assets/manual.pdf" target="_blank" class="footer-link fw-bolder">Klik disini untuk membaca User Manual</a>
            </div>
        </div> --}}
    </footer>
</div>
<script>
    function getGreeting() {
        const currentHour = new Date().getHours();
        if (currentHour >= 5 && currentHour < 11) {
            return 'Pagi';
        }else if (currentHour >= 11 && currentHour < 15) {
            return 'Siang';
        }else if (currentHour >= 15 <= 18) {
            return 'Sore'
        } else {
            return 'Malam';
        }
    }
    // Function to update greetings, date, and time
    function updateElements() {
        // Get the elements by their IDs
        const greetingsElement = document.getElementById('greetings');
        const dateNowElement = document.getElementById('dateNow');
        const timeNowElement = document.getElementById('timeNow');

        // Get the current date and time
        const options = {
            weekday: 'long', // Displays the day of the week in full (e.g., "Senin")
            day: 'numeric', // Displays the day of the month as a number (e.g., "26")
            month: 'long', // Displays the month in full (e.g., "July")
            year: 'numeric' // Displays the year as a number (e.g., "2023")
        };

        const currentDate = new Date();
        const currentDateString = currentDate.toLocaleDateString('ID-Id',options);
        const currentTimeString = currentDate.toLocaleTimeString();
        // Update the elements' innerHTML with real-time data
        greetingsElement.innerHTML = getGreeting();
        dateNowElement.innerHTML = currentDateString;
        timeNowElement.innerHTML = currentTimeString;
    }

    // Run the updateElements function when the page is ready
    document.addEventListener('DOMContentLoaded', function () {
        updateElements();

        // Update the elements every second (1000 milliseconds)
        setInterval(updateElements, 1000);
    });
</script>
@endsection
