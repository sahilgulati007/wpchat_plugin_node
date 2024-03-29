<?php
/**
 * Plugin Name: Chat plugin
 * Description: to provide chat with node.
 * Version: 1.0
 * Author: Sahil Gulati
 * Author URI: http://www.facebook.com/sahilgulati007
 */

 add_action('admin_menu', 'at_mlm_menu');
function at_mlm_menu()
{
	//adding plugin in menu
    add_menu_page('chat_admin', //page title
        'Chat Admin', //menu title
        'manage_options', //capabilities
        'Chat_Admin', //menu slug
        'chat_admin_function' //function
    );
}

function chat_admin_function()
{
	echo "welcome to chat page";
	echo "<a href=''>test</a>"; 
}

function chat_footer(){
	?>
	<style>
    html, body {
  background: #efefef;      
  height:100%;  
}
#center-text {          
  display: flex;
  flex: 1;
  flex-direction:column; 
  justify-content: center;
  align-items: center;  
  height:100%;
  
}
#chat-circle {
  position: fixed;
  bottom: 50px;
  right: 50px;
  background: #5A5EB9;
  /*width: 80px;
  height: 80px;*/  
  border-radius: 50%;
  color: white;
  padding: 28px;
  cursor: pointer;
  box-shadow: 0px 3px 16px 0px rgba(0, 0, 0, 0.6), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}

.btn#my-btn {
     background: white;
    padding-top: 13px;
    padding-bottom: 12px;
    border-radius: 45px;
    padding-right: 40px;
    padding-left: 40px;
    color: #5865C3;
}
#chat-overlay {
    background: rgba(255,255,255,0.1);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    display: none;
}


.chat-box {
  display:none;
  background: #efefef;
  position:fixed;
  right:30px;
  bottom:50px;  
  width:350px;
  max-width: 85vw;
  max-height:100vh;
  border-radius:5px;  
/*   box-shadow: 0px 5px 35px 9px #464a92; */
  box-shadow: 0px 5px 35px 9px #ccc;
}
.chat-box-toggle {
  float:right;
  margin-right:15px;
  cursor:pointer;
}
.chat-box-header {
  background: #5A5EB9;
  height:70px;
  border-top-left-radius:5px;
  border-top-right-radius:5px; 
  color:white;
  text-align:center;
  font-size:20px;
  padding-top:17px;
}
.chat-box-body {
  position: relative;  
  height:370px;  
  height:auto;
  border:1px solid #ccc;  
  overflow: hidden;
}
.chat-box-body:after {
  content: "";
  background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDIwMCAyMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMTAgOCkiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCI+PGNpcmNsZSBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgY3g9IjE3NiIgY3k9IjEyIiByPSI0Ii8+PHBhdGggZD0iTTIwLjUuNWwyMyAxMW0tMjkgODRsLTMuNzkgMTAuMzc3TTI3LjAzNyAxMzEuNGw1Ljg5OCAyLjIwMy0zLjQ2IDUuOTQ3IDYuMDcyIDIuMzkyLTMuOTMzIDUuNzU4bTEyOC43MzMgMzUuMzdsLjY5My05LjMxNiAxMC4yOTIuMDUyLjQxNi05LjIyMiA5LjI3NC4zMzJNLjUgNDguNXM2LjEzMSA2LjQxMyA2Ljg0NyAxNC44MDVjLjcxNSA4LjM5My0yLjUyIDE0LjgwNi0yLjUyIDE0LjgwNk0xMjQuNTU1IDkwcy03LjQ0NCAwLTEzLjY3IDYuMTkyYy02LjIyNyA2LjE5Mi00LjgzOCAxMi4wMTItNC44MzggMTIuMDEybTIuMjQgNjguNjI2cy00LjAyNi05LjAyNS0xOC4xNDUtOS4wMjUtMTguMTQ1IDUuNy0xOC4xNDUgNS43IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+PHBhdGggZD0iTTg1LjcxNiAzNi4xNDZsNS4yNDMtOS41MjFoMTEuMDkzbDUuNDE2IDkuNTIxLTUuNDEgOS4xODVIOTAuOTUzbC01LjIzNy05LjE4NXptNjMuOTA5IDE1LjQ3OWgxMC43NXYxMC43NWgtMTAuNzV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjcxLjUiIGN5PSI3LjUiIHI9IjEuNSIvPjxjaXJjbGUgZmlsbD0iIzAwMCIgY3g9IjE3MC41IiBjeT0iOTUuNSIgcj0iMS41Ii8+PGNpcmNsZSBmaWxsPSIjMDAwIiBjeD0iODEuNSIgY3k9IjEzNC41IiByPSIxLjUiLz48Y2lyY2xlIGZpbGw9IiMwMDAiIGN4PSIxMy41IiBjeT0iMjMuNSIgcj0iMS41Ii8+PHBhdGggZmlsbD0iIzAwMCIgZD0iTTkzIDcxaDN2M2gtM3ptMzMgODRoM3YzaC0zem0tODUgMThoM3YzaC0zeiIvPjxwYXRoIGQ9Ik0zOS4zODQgNTEuMTIybDUuNzU4LTQuNDU0IDYuNDUzIDQuMjA1LTIuMjk0IDcuMzYzaC03Ljc5bC0yLjEyNy03LjExNHpNMTMwLjE5NSA0LjAzbDEzLjgzIDUuMDYyLTEwLjA5IDcuMDQ4LTMuNzQtMTIuMTF6bS04MyA5NWwxNC44MyA1LjQyOS0xMC44MiA3LjU1Ny00LjAxLTEyLjk4N3pNNS4yMTMgMTYxLjQ5NWwxMS4zMjggMjAuODk3TDIuMjY1IDE4MGwyLjk0OC0xOC41MDV6IiBzdHJva2U9IiMwMDAiIHN0cm9rZS13aWR0aD0iMS4yNSIvPjxwYXRoIGQ9Ik0xNDkuMDUgMTI3LjQ2OHMtLjUxIDIuMTgzLjk5NSAzLjM2NmMxLjU2IDEuMjI2IDguNjQyLTEuODk1IDMuOTY3LTcuNzg1LTIuMzY3LTIuNDc3LTYuNS0zLjIyNi05LjMzIDAtNS4yMDggNS45MzYgMCAxNy41MSAxMS42MSAxMy43MyAxMi40NTgtNi4yNTcgNS42MzMtMjEuNjU2LTUuMDczLTIyLjY1NC02LjYwMi0uNjA2LTE0LjA0MyAxLjc1Ni0xNi4xNTcgMTAuMjY4LTEuNzE4IDYuOTIgMS41ODQgMTcuMzg3IDEyLjQ1IDIwLjQ3NiAxMC44NjYgMy4wOSAxOS4zMzEtNC4zMSAxOS4zMzEtNC4zMSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utd2lkdGg9IjEuMjUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIvPjwvZz48L3N2Zz4=');
  opacity: 0.1;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  height:100%;
  position: absolute;
  z-index: -1;   
}
#chat-input {
  background: #f4f7f9;
  width:90%; 
  position:relative;
  height:47px;  
  padding-top:10px;
  padding-right:50px;
  padding-bottom:10px;
  padding-left:15px;
  border:none;
  resize:none;
  outline:none;
  border:1px solid #ccc;
  color:#888;
  border-top:none;
  border-bottom-right-radius:5px;
  border-bottom-left-radius:5px;
  overflow:hidden;  
}
.chat-input > form {
    margin-bottom: 0;
}
#chat-input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: #ccc;
}
#chat-input::-moz-placeholder { /* Firefox 19+ */
  color: #ccc;
}
#chat-input:-ms-input-placeholder { /* IE 10+ */
  color: #ccc;
}
#chat-input:-moz-placeholder { /* Firefox 18- */
  color: #ccc;
}
.chat-submit {  
  position:absolute;
  bottom:3px;
  right:10px;
  background: transparent;
  box-shadow:none;
  border:none;
  border-radius:50%;
  color:#5A5EB9;
  width:35px;
  height:35px;  
}
.chat-logs {
  padding:15px; 
  height:370px;
  overflow-y:scroll;
}

.chat-logs::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.chat-logs::-webkit-scrollbar
{
    width: 5px;  
    background-color: #F5F5F5;
}

.chat-logs::-webkit-scrollbar-thumb
{
    background-color: #5A5EB9;
}



@media only screen and (max-width: 500px) {
   .chat-logs {
        height:40vh;
    }
}

.chat-msg.user > .msg-avatar img {
  width:45px;
  height:45px;
  border-radius:50%;
  float:left;
  width:15%;
}
.chat-msg.self > .msg-avatar img {
  width:45px;
  height:45px;
  border-radius:50%;
  float:right;
  width:15%;
}
.cm-msg-text {
  background:white;
  padding:10px 15px 10px 15px;  
  color:#666;
  max-width:75%;
  float:left;
  margin-left:10px; 
  position:relative;
  margin-bottom:20px;
  border-radius:30px;
}
.chat-msg {
  clear:both;    
}
.chat-msg.self > .cm-msg-text {  
  float:right;
  margin-right:10px;
  background: #5A5EB9;
  color:white;
}
.cm-msg-button>ul>li {
  list-style:none;
  float:left;
  width:50%;
}
.cm-msg-button {
    clear: both;
    margin-bottom: 70px;
}
.chat-box-body,.chat-input{
    display: none;
}
</style>
	<script src="http://192.168.0.164:3000/socket.io/socket.io.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        $(function () {
            var INDEX=0;
            var socket = io('http://192.168.0.164:3000/');
            $('#msg').submit(function(e){
                e.preventDefault(); // prevents page reloading

                var data={
                    tem:$('#tnm').val(),
                    fem:$('#fnm').val(),
                    msg:$('#chat-input').val()
                };
                socket.emit('private-message-admin', data);
                $('#chat-input').val('');
                return false;
            });
            $('#reg').submit(function(e){
                e.preventDefault(); // prevents page reloading
                $('.chat-box-body').css('display','block');
                $('.chat-input').css('display','block');
                $('.login').css('display','none');
                var data={
                    em:$('#em').val(),
                    nm:$('#nm').val()
                };
                $('#fnm').val($('#em').val());
                sessionStorage.setItem('em',$('#em').val());
                socket.emit('add-user', data);
                $.post("http://192.168.0.164:3000/getchat", {em: $('#em').val()}, function(result){
                    console.log(result);
                    //$("span").html(result);
                    
                    result.forEach(function(item,index){
                    var html='';
                    if(item.type=="outgoing"){
                        html+="<li >"+item.msg+" </li>";
                        //generate_message(msg, 'self');
                        var str="";
                        str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg self\">";
                        str += "          <span class=\"msg-avatar\">";
                        str += "            <img src='http://192.168.0.164:3000/img/user.png'>";
                        str += "          <\/span>";
                        str += "          <div class=\"cm-msg-text\">";
                        str += item.msg;
                        str += "          <\/div>";
                        str += "        <\/div>";
                        $(".chat-logs").append(str);
                    
                    }
                    else{
                        html+="<li >"+item.msg+" </li>";
                        //generate_message(msg, 'user');
                         var str="";
                        str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg user\">";
                        str += "          <span class=\"msg-avatar\">";
                        str += "            <img src='http://192.168.0.164:3000/img/admin.png'>";
                        str += "          <\/span>";
                        str += "          <div class=\"cm-msg-text\">";
                        str += item.msg;
                        str += "          <\/div>";
                        str += "        <\/div>";
                        $(".chat-logs").append(str);
                    }
                    INDEX++;
                    $('#messages').append(html);

                    });
                });
                $('#em').val('');
                $('#nm').val('');
                return false;
            });
            socket.on('private-message-user', function(msg){
                debugger
                $('#messages').append($('<li>').text(msg));
                var str="";
                str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg self\">";
                str += "          <span class=\"msg-avatar\">";
                str += "            <img src='http://192.168.0.164:3000/img/user.png'>";
                str += "          <\/span>";
                str += "          <div class=\"cm-msg-text\">";
                str += msg;
                str += "          <\/div>";
                str += "        <\/div>";
                $(".chat-logs").append(str);
            });
            socket.on('private-message-admin', function(msg){
                debugger
                $('#messages').append($('<li>').text(msg));
                var str="";
                str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg user\">";
                str += "          <span class=\"msg-avatar\">";
                str += "            <img src='http://192.168.0.164:3000/img/admin.png'>";
                str += "          <\/span>";
                str += "          <div class=\"cm-msg-text\">";
                str += msg;
                str += "          <\/div>";
                str += "        <\/div>";
                $(".chat-logs").append(str);
            });
           
            $("#chat-circle").click(function() {    
            $("#chat-circle").toggle('scale');
            $(".chat-box").toggle('scale');
          });
          
          $(".chat-box-toggle").click(function() {
            $("#chat-circle").toggle('scale');
            $(".chat-box").toggle('scale');
          });
          if(sessionStorage.getItem('em')){
            $('#fnm').val(sessionStorage.getItem('em'));
                //sessionStorage.setItem('em',$('#em').val());
                debugger
                $('.chat-box-body').css('display','block');
                $('.chat-input').css('display','block');
                $('.login').css('display','none');
                //socket.emit('add-user', data);
                $.post("http://192.168.0.164:3000/getchat", {em: sessionStorage.getItem('em')}, function(result){
                    console.log(result);
                    //$("span").html(result);
                    //var INDEX=0;
                    result.forEach(function(item,index){
                    var html='';
                    if(item.type=="outgoing"){
                        html+="<li >"+item.msg+" </li>";
                        //generate_message(msg, 'self');
                        var str="";
                        str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg self\">";
                        str += "          <span class=\"msg-avatar\">";
                        str += "            <img src='http://192.168.0.164:3000/img/user.png'>";
                        str += "          <\/span>";
                        str += "          <div class=\"cm-msg-text\">";
                        str += item.msg;
                        str += "          <\/div>";
                        str += "        <\/div>";
                        $(".chat-logs").append(str);
                    
                    }
                    else{
                        html+="<li >"+item.msg+" </li>";
                        //generate_message(msg, 'user');
                         var str="";
                        str += "<div id='cm-msg-"+INDEX+"' class=\"chat-msg user\">";
                        str += "          <span class=\"msg-avatar\">";
                        str += "            <img src='http://192.168.0.164:3000/img/admin.png'>";
                        str += "          <\/span>";
                        str += "          <div class=\"cm-msg-text\">";
                        str += item.msg;
                        str += "          <\/div>";
                        str += "        <\/div>";
                        $(".chat-logs").append(str);
                    }
                    INDEX++;
                    $('#messages').append(html);

                    });
                });
          }
        });

       
    </script>

		<div id="chat-circle" class="btn btn-raised">
        <div id="chat-overlay"></div>
            <i class="material-icons">speaker_phone</i>
    </div>
  
  <div class="chat-box">
    <div class="chat-box-header">
      ChatBot
      <span class="chat-box-toggle"><i class="material-icons">close</i></span>
    </div>
    <div class="login">
        <form action="" id="reg" >
            <input name="email" id="em" type="email" placeholder="Enter Email" required style="width: 80%;margin: 5%;padding: 5%">
            <input type="text" name="nm" id="nm" placeholder="Enter Name" required style="width: 80%;margin: 5%; padding: 5%">
            <button type="submit" style="width: 90%;padding: 5%;margin: 5%;background: #5A5EB9;color: white;">Start Chat</button>
        </form>
    </div>
    <div class="chat-box-body">
      <div class="chat-box-overlay">   
      </div>
      <div class="chat-logs">
       
      </div><!--chat-log -->
    </div>
    <div class="chat-input">      
      <form action="" id="msg">
        <input id="tnm" placeholder="to user" type="hidden" value="testadmin@gm.com">
        <input id="fnm" type="hidden" value="">
        <input type="text" id="chat-input" placeholder="Send a message..."/>
      <button type="submit" class="chat-submit" id="chat-submit"><i class="material-icons">send</i></button>
      </form>      
    </div>
  </div>
	<?php

}
add_action( 'wp_footer', 'chat_footer' );
// define('ROOTDIR', plugin_dir_path(__FILE__));
// require_once(ROOTDIR . 'chat_admin.php');