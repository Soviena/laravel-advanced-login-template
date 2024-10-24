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
                        @foreach ($chatUsers as $u)
                        <li class="list-group-item px-0 btn @if($aite->id == $u->id) btn-secondary @else btn-outline-secondary @endif" onclick="window.location.href='{{route('chatTo',$u->id)}}'">
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
                                        @if ($u->unread_count > 0 )
                                            <span class="badge bg-danger badge-center rounded-pill float-right" id="unread-{{$u->id}}">{{$u->unread_count}}</span>
                                        @endif
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
                        @isset($aite)
                            <div class="avatar avatar-online">
                                <img src="{{asset('storage/uploaded/user')}}@if($aite->user_data->profile_picture == "")/default.jpeg @else/{{$aite->user_data->profile_picture}} @endif" alt="" class="w-px-40 h-auto rounded-circle">
                            </div>
                        @endisset
                    </div>
                    <div class="col-10">
                        @isset($aite)
                        {{$aite->user_data->first_name}} {{$aite->user_data->last_name}}
                        @endisset
                    </div>
                </div>
                <hr>
                <div class="row" style="max-height: 77vh; min-height: 77vh;">
                    <div class="container" id="chat-body">

                        @isset($messages)
                            @foreach ($messages as $m)
                            @if ($m->from_id != $user->id)
                                @php
                                    $m->is_read = true;
                                    $m->save();
                                @endphp
                            @endif
                            <div class="container @if($m->from_id == $user->id) text-end @endif">
                                <div class="container">
                                    {{$m->chat->body}}
                                </div>
                            </div>

                            @endforeach
                        @endisset

                    </div>
                </div>
                @isset($aite)
                    <div class="row mx-2 pb-2">
                        <form method="POST" action="{{route('sendChat')}}">
                            @csrf
                            <input type="hidden" name="to_id" value="{{$aite->id}}">
                            <input class="col-10 me-2" type="text" name="body" id="text-input">
                            <button class="col btn btn-primary" type="submit" onclick="sendMessage()">Send</button>
                        </form>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
<script>
    var chatBody = document.getElementById('chat-body');
    @if($aite->id != $user->id)
        setTimeout(() => {
            window.Echo.private('chatToUser.{{$aite->id}}.{{$user->id}}')
            .listen('gotMessage', (e) => {
                chatBody.insertAdjacentHTML('beforeend',`
                    <div class="container">
                        <div class="container">
                            ${e.chat.body}
                        </div>
                    </div>
                `)
            });
            console.log("Listening to chatToUser.{{$aite->id}}.{{$user->id}}");
        }, 1000);

        const messageRequest = (text) => {
            try {
                $.post("{{route('sendChat')}}", {
                    _token: '{{csrf_token()}}',
                    to_id: '{{$aite->id}}',
                    body: text
                });
                chatBody.insertAdjacentHTML('beforeend',`
                    <div class="container">
                        <div class="container text-end">
                            ${text}
                        </div>
                    </div>
                `)
            } catch (err) {
                console.log(err.message);
            }
        };
        function sendMessage(){
            event.preventDefault();
            let TextInput = document.getElementById('text-input')
            let message = TextInput.value
            if (message.trim() === "") {
                alert("Please enter a message!");
                return;
            }
            messageRequest(message);
            TextInput.value = ""
        }
    @endif
</script>
@endsection

