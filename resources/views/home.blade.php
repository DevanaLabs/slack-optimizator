@extends('layouts.app')

@section('inner')
    <div class="sideBarIcon" onclick="showSideBar()">
        <hr/>
        <hr/>
        <hr/>
    </div>
    <div class="sideBar">
        <div class="info">
            <div class="teamName"><a href="{{url('/')}}">{{Auth::user()->team_name}}</a></div>
            <div class="mainUser">{{Auth::user()->name}}</div>
        </div>
        <div class="section">CHANNELS <span class="plus">+</span></div>
        @foreach($channels as $channel)
            <div class="channels"><a href="/channels/chat/{{$channel->chat_id}}">&#35{{$channel->name}}</a></div><br>
        @endforeach
        <div class="section">DIRECT MESSAGES <span class="plus">+</span></div>
        @foreach($ims as $im)
            <div class="channels"><a href="/ims/chat/{{$im->chat_id}}">&#64{{$im->username}}</a></div><br>
        @endforeach
    </div>
    <div class="content">
        @if(empty($history))
            <div class="welcome">Welcome</div>
        @endif
        <form method="post" action="{{url('/' . $chatId)}}">
            {{csrf_field()}}

            <div class="userInfo">
                <div class="sideBarMask" onclick="hideSideBar()"></div>
                <p class="fullName">{{$chatName}}</p>
                <a href="{{ url('/logout') }}" class="logout"
                   onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                    Logout
                </a>
            </div>
            <div class="historyMessages">
                @foreach($history as $message)
                    <div class="userName">&#64{{$message['username']}}</div>
                    <div class="messageTime">{{$message['timestamp']}}</div>
                    <p class="message">{{$message['text']}}</p>
                @endforeach
            </div>
            @if($history)
            <div class="sendWrapper">
                <textarea name="message" rows="1" class="newMessage"></textarea>
                <input type="submit" value="Send" class="sendMessage">
            </div>
            @endif
        </form>
    </div>

@endsection
