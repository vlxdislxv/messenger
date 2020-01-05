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
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="../img/no-avatar.png" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span>Chat with USERNAME</span>
                            <p>COUNT Messages</p>
                        </div>
                    </div>
                </div>
                <div class="card-body msg_card_body">
                    <div class="d-flex justify-content-end mb-4">
                        <div class="msg_cotainer_send">
                            Message
                            <span class="msg_time_send">Time, Yesterday</span>
                        </div>
                        <div class="img_cont_msg">
                            <img src="../img/no-avatar.png" class="rounded-circle user_img_msg">
                        </div>
                    </div>
                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="../img/no-avatar.png" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            Message
                            <span class="msg_time">Time, Yesterday</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                        </div>
                        <input name="" class="form-control type_msg" placeholder="Type your message...">
                        <div class="input-group-append">
                            <span class="input-group-text send_btn"><i class="fas fa-paper-plane"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>