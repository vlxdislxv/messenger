<?php

use \app\modules\home\assets\DefaultAsset;

$theme = DefaultAsset::register($this);

$this->title = 'Home';

?>

<div class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
                <div class="card-header">
                    <div class="input-group">
                        <input id="contact_search" type="text" placeholder="Search..."
                               name="UserSearch[username]" class="form-control search" value="">
                        <div class="input-group-prepend">
                            <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="card-body contacts_body scrollbar scrollbar-primary">
                    <ui class="contacts">
<!--                        <li class="active">-->
<!--                        <li>-->
<!--                            <div class="d-flex bd-highlight">-->
<!--                                <div class="img_cont">-->
<!--                                    <img src="../img/no-avatar.png" class="rounded-circle user_img">-->
<!--                                    <span class="online_icon"></span>-->
<!--                                </div>-->
<!--                                <div class="user_info">-->
<!--                                    <span>USERNAME</span>-->
<!--                                    <p>STATUS</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </li>-->
                    </ui>
                </div>
                <div class="card-footer"></div>
            </div></div>
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                <div id="msg_header" class="card-header msg_head d-none">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="../img/no-avatar.png" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span id="chat_with">Chat with USERNAME</span>
                            <p id="msg_count">COUNT Messages</p>
                        </div>
                    </div>
                </div>
                <div id="messages_block" class="card-body msg_card_body">
                    <div class="h-100 w-100 d-flex justify-content-center align-items-center">
                        <h1 class="d-flex flex-column align-items-center" style="color: white">
                            <p id="select_msg">Select The Chat</p>
                            <hr>
                            <i class="fas fa-comments"></i>
                        </h1>
                    </div>
                </div>
                <div id="msg_block" class="card-footer d-none">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span onclick="alert('В разработке')" class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                        </div>
                        <input id="msg" name="" class="form-control type_msg" placeholder="Type your message...">
                        <div class="input-group-append">
                            <span id="send_msg" class="input-group-text send_btn"><i class="fas fa-paper-plane"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>