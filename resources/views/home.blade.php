@extends('layouts.app')

@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 col-xl-3 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <input type="text" placeholder="Search..." name="" class="form-control search">
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body contacts_body">
                        <ul class="contacts">
                            @foreach ($users as $user)
                                <li class="active">
                                    <a href="{{route('home',$user)}}">
                                        <div class="d-flex bd-highlight">
                                            <div class="img_cont">
                                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                                    class="rounded-circle user_img">
                                                <span class="online_icon"></span>
                                            </div>
                                            <div class="user_info">
                                                <span>{{ $user->name }}</span>
                                            </div>
                                        </div>
                                    </a>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>


            @if ($user_chat && request('id'))
                <div class="col-md-8 col-xl-6 chat">
                    <div class="card">
                        <div class="card-header msg_head">
                            <div class="d-flex bd-highlight">
                                <div class="img_cont">
                                    <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                        class="rounded-circle user_img">
                                    <span class="online_icon"></span>
                                </div>
                                <div class="user_info">
                                    <span>Chat with {{ $user_chat->name }}</span>
                                    <p>1767 Messages</p>
                                </div>
                                <div class="video_cam">
                                    <span><i class="fas fa-video"></i></span>
                                    <span><i class="fas fa-phone"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body msg_card_body">
                            @foreach ($messages as $message)
                                @if ($message->sender_id == auth()->id())
                                    <div class="d-flex justify-content-start mb-4">
                                        <div class="img_cont_msg">
                                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                                class="rounded-circle user_img_msg">
                                        </div>
                                        <div class="msg_cotainer">
                                            {{$message->message}}
                                            <span class="msg_time">8:40 AM, Today</span>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-end mb-4">
                                        <div class="msg_cotainer_send">
                                            {{$message->message}}
                                            <span class="msg_time_send">8:55 AM, Today</span>
                                        </div>
                                        <div class="img_cont_msg">
                                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg"
                                                class="rounded-circle user_img_msg">
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <div class="card-footer">
                            <form action="{{ route('message.store', $user_chat->id) }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                                    </div>
                                    <textarea name="message" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text send_btn"><i
                                                class="fas fa-location-arrow"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
