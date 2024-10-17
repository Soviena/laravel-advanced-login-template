@extends('layout.layout')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid px-5 py-3">
        <div class="row">
            <div class="col-4 card me-2">
                <div class="container">
                    <h4>Chats</h4>
                </div>
                <div class="container px-0">
                    <ul class="list-group list-group-flush">

                        @foreach ($user->chatUsers as $u)
                        <li class="list-group-item px-0 btn btn-outline-secondary">
                            <div class="row">
                                <div class="col-2">
                                    <div class="avatar avatar-online">
                                        <img src="{{asset('storage/uploaded/user')}}@if($u->user_data->profile_picture == "")/default.jpeg @else/{{$u->user_data->profile_picture}} @endif" alt="" class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        {{$u->username}}
                                    </div>
                                    <div class="row">
                                        {{$u->email}}
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="row">4:14 PM</div>
                                    <div class="row">
                                        <span class="badge bg-danger badge-center rounded-pill float-right">5</span>
                                    </div>
                                </div>
                            </div>
                        </li>

                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="col card">
                <div class="row mx-2 pt-3">
                    <div class="col-2">
                        <div class="avatar avatar-online">
                            <img src="http://127.0.0.1:8000/storage/uploaded/user/xOWMs3lTL0Esuq3MfFUAJStvWMm6yoGKV59jDSKJ.png " alt="" class="w-px-40 h-auto rounded-circle">
                        </div>
                    </div>
                    <div class="col-10">
                        Your Name
                    </div>
                </div>
                <hr>
                <div class="row" style="max-height: 77vh; min-height: 77vh;">
                    <div class="container">
                        <div class="container">
                            <div class="container">
                                Hello
                            </div>
                            <div class="container">
                                World
                            </div>
                        </div>
                        <div class="container">
                            <div class="container">
                                Hello
                            </div>
                            <div class="container">
                                World
                            </div>
                        </div>
                        <div class="container text-end">
                            <div class="container">
                                Hello
                            </div>
                            <div class="container">
                                World
                            </div>
                        </div>
                        <div class="container ">
                            <div class="container">
                                Hello
                            </div>
                        </div>
                        <div class="container text-end">
                            <div class="container">
                                Hello
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-2 pb-2">
                    <input class="col-10 me-2" type="text" name="" id="">
                    <button class="col btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>

</script>
