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
            <div class="container-xxl flex-grow-1 container-p-y">
                <h3 class="fw-bold py-3 mb-4 text-center">Daftar User</h3>
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                            <table class="table" id="tableUser">
                                <thead>
                                    <tr>
                                        <th style='width:1vw;'>Avatar</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone Number</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($users as $u)
                                        <tr>
                                            <td>
                                                <div class="btn-group dropend">
                                                    <img class="rounded-circle mb-2 mx-auto shadow img-thumbnail dropdown-toggle"
                                                        src="{{asset('storage/uploaded/user')}}@if($u->user_data->profile_picture == "")/default.jpeg @else/{{$u->user_data->profile_picture}} @endif"
                                                        alt="{{ $u->user_data->first_name }}"
                                                        style="object-fit: cover; object-position: 25% 25%;cursor: pointer;"
                                                        data-bs-toggle="dropdown">
                                                    <div class="dropdown-menu pt-0 pb-5" style=" width: 20vw;">
                                                        <div class="card-img-top" style="background-image: url({{asset('storage/uploaded/user/')}}@if($u->user_data->cover_picture == "")/default_cover.png  @else/{{$u->user_data->cover_picture}} @endif); background-size:cover; background-position:center; height: 7vw; min-height:63px">
                                                            <div class="d-flex justify-content-start">
                                                                <div class="d-flex" style="margin-top: 22%; margin-left:20px">
                                                                    <div class="d-block" style="position: relative; display: inline-block;">
                                                                        <img class="rounded-circle" src="{{asset('storage/uploaded/user/')}}@if($u->user_data->profile_picture == "")/default.jpeg @else/{{$u->user_data->profile_picture}} @endif" id="profilePic" alt="user-avatar" style="width:5.5vw; min-width:55px; max-width:85px" id="uploadedAvatar">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body p-0 container" style="margin-left: 0">
                                                            <div class="p-0 me-2 justify-content-end">
                                                                <p class="" style="text-align: right; font-size: 14px; margin:0;">{{$u->user_data->phone_number}}</p>
                                                            </div>
                                                            <div class="p-0 me-2 justify-content-end">
                                                                <p class="" style="text-align: right; font-size: 14px; margin:0;">{{$u->user_data->date_of_birth}}</p>
                                                            </div>
                                                            <div class="p-0 ms-3" style="">
                                                                <p style="font-weight:bold; font-size: 18px; margin:0">{{$u->user_data->first_name}} {{$u->user_data->last_name}}</p>
                                                            </div>
                                                            <div class="p-0 ms-3" style="">
                                                                <p style="font-size: 16px; margin:0">{{$u->username}}</p>
                                                            </div>
                                                            <div class="p-0 ms-3" style="">
                                                                <p class="badge @if($u->email_verified_at) bg-label-primary @else bg-label-danger @endif" style="font-size: 10px; margin:0">@if($u->email_verified_at) Verified @else Not Verified @endif</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $u->user_data->first_name }}</td>
                                            <td>{{ $u->user_data->last_name }}</td>
                                            <td>{{ $u->user_data->phone_number }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
