<?php
include './includes/header.php';
include './includes/sidebar.php';
include './includes/navbar.php';
include '../db.php';

$sql = $conn->query("SELECT * FROM `live_messages`");
$persons = [];
$messages = [];
while ($row = $sql->fetch_assoc()) {
    $persons[] = $row['user_id'];
    $messages[] = $row;
}
$persons = array_unique($persons);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    $id = (int)$_POST['id']; 

    if ($conn->query("INSERT INTO live_messages (`user_id`, `message`, `role`) VALUES ('$id', '$message', 1)")) {
        header("Location: {$_SERVER['PHP_SELF']}?id={$_GET['id']}");
        exit; 
    }
}


?>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<style>
    body {
        background-color: #f4f7f6;
        margin-top: 20px;
    }

    .card {
        background: #fff;
        transition: .5s;
        border: 0;
        margin-bottom: 30px;
        border-radius: .55rem;
        position: relative;
        width: 100%;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
    }

    .chat-app .people-list {
        width: 280px;
        position: absolute;
        left: 0;
        top: 0;
        padding: 20px;
        z-index: 7
    }

    .chat-app .chat {
        margin-left: 280px;
        border-left: 1px solid #eaeaea
    }

    .people-list {
        -moz-transition: .5s;
        -o-transition: .5s;
        -webkit-transition: .5s;
        transition: .5s
    }

    .people-list .chat-list li {
        padding: 10px 15px;
        list-style: none;
        border-radius: 3px
    }

    .people-list .chat-list li:hover {
        background: #efefef;
        cursor: pointer
    }

    .people-list .chat-list li.active {
        background: #efefef
    }

    .people-list .chat-list li .name {
        font-size: 15px
    }

    .people-list .chat-list img {
        width: 45px;
        border-radius: 50%
    }

    .people-list img {
        float: left;
        border-radius: 50%
    }

    .people-list .about {
        float: left;
        padding-left: 8px
    }

    .people-list .status {
        color: #999;
        font-size: 13px
    }

    .chat .chat-header {
        padding: 15px 20px;
        border-bottom: 2px solid #f4f7f6
    }

    .chat .chat-header img {
        float: left;
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-header .chat-about {
        float: left;
        padding-left: 10px
    }

    .chat .chat-history {
        padding: 20px;
        border-bottom: 2px solid #fff
    }

    .chat .chat-history ul {
        padding: 0
    }

    .chat .chat-history ul li {
        list-style: none;
        margin-bottom: 30px
    }

    .chat .chat-history ul li:last-child {
        margin-bottom: 0px
    }

    .chat .chat-history .message-data {
        margin-bottom: 15px
    }

    .chat .chat-history .message-data img {
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-history .message-data-time {
        color: #434651;
        padding-left: 6px
    }

    .chat .chat-history .message {
        color: #444;
        padding: 18px 20px;
        line-height: 26px;
        font-size: 16px;
        border-radius: 7px;
        display: inline-block;
        position: relative
    }


    .chat .chat-history .my-message {
        background: #efefef
    }

    

    .chat .chat-history .other-message {
        background: #e8f1f3;
        text-align: right
    }

    

    .chat .chat-message {
        padding: 20px
    }

    .online,
    .offline,
    .me {
        margin-right: 2px;
        font-size: 8px;
        vertical-align: middle
    }

    .online {
        color: #86c541
    }

    .offline {
        color: #e47297
    }

    .me {
        color: #1d8ecd
    }

    .float-right {
        float: right
    }

    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0
    }
    .chat-app .chat {
    margin-left: 280px;
    border-left: 1px solid #eaeaea;
}

.chat-app .chat-history {
    padding: 20px;
    border-bottom: 2px solid #fff;
    height: 300px; /* Adjust this height to fit your needs */
    overflow-y: auto; /* Add overflow-y auto here */
    overflow-x: hidden; 
}

.chat-app .chat-history ul {
    padding: 0;
}

.chat-app .chat-history ul li {
    list-style: none;
    margin-bottom: 30px;
}

.chat-app .chat-history ul li:last-child {
    margin-bottom: 0px;
}

.chat-app .chat-history .message-data {
    margin-bottom: 15px;
}

.chat-app .chat-history .message-data img {
    border-radius: 40px;
    width: 40px;
}

.chat-app .chat-history .message-data-time {
    color: #434651;
    padding-left: 6px;
}

.chat-app .chat-history .message {
    color: #444;
    padding: 18px 20px;
    line-height: 26px;
    font-size: 16px;
    border-radius: 7px;
    display: inline-block;
    position: relative;
}



.chat-app .chat-history .my-message {
    background: #efefef;
}



.chat-app .chat-history .other-message {
    background: #e8f1f3;
    text-align: right;
}



    @media only screen and (max-width: 767px) {
        .chat-app .people-list {
            height: 465px;
            width: 100%;
            background: #fff;
            left: -400px;
            display: none
        }

        .chat-app .people-list.open {
            left: 0
        }

        .chat-app .chat {
            margin: 0
        }

        .chat-app .chat .chat-header {
            border-radius: 0.55rem 0.55rem 0 0
        }

        .chat-app .chat-history {
            height: 300px;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 992px) {
        .chat-app .chat-list {
            height: 650px;
        }

        .chat-app .chat-history {
            height: 600px;
        }
    }

    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
        .chat-app .chat-list {
            height: 480px;
        }

        .chat-app .chat-history {
            height: calc(100vh - 350px);
        }
    }
</style>
<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div id="plist" class="people-list">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <ul class="list-unstyled chat-list mt-2 mb-0">
                        <?php
                        foreach ($persons as $person) {
                            $sql = $conn->query("SELECT `f_name` , `l_name` FROM `users` WHERE `id` = '$person'");
                            $sql = $sql->fetch_assoc();

                            echo "<li class='clearfix " . ((isset($_GET['id']) && ($_GET['id'] == $person)) ? 'active' : '') . "'><a href = '{$_SERVER['PHP_SELF']}?id=$person'>
                        <img src='https://bootdey.com/img/Content/avatar/avatar1.png' alt='avatar'>
                        <div class='about'>
                            <div class='name'>{$sql['f_name']} {$sql['l_name']}</div>
                        </div>
                    </li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="chat" style="overflow-y: hidden; height:100%" >
                    
                    <?php
                    if (isset($_GET['id'])) {
                        $activeUser = $conn->query("SELECT `f_name` , `l_name` FROM `users` WHERE `id` = '{$_GET['id']}'");
                        $activeUser = $activeUser -> fetch_assoc();
                        $sqlmessages = $conn -> query("SELECT * FROM `live_messages` WHERE `user_id` = '{$_GET['id']}'");
                        $messages = [];
                        while($row = $sqlmessages -> fetch_assoc()){
                            $messages[] = $row;
                        }
                        echo "
                        <div class='chat-header clearfix'>
                            <div class='row'>
                                <div class='col-lg-6'>
                                    <a href='javascript:void(0);' data-toggle='modal' data-target='#view_info'>
                                        <img src='https://bootdey.com/img/Content/avatar/avatar1.png' alt='avatar'>
                                    </a>
                                    <div class='chat-about'>
                                        <h6 class='m-b-0'>{$activeUser['f_name']} {$activeUser['l_name']}</h6>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class='chat-history' id = 'chatBody'>
                                <ul class='m-b-0' style = 'overflow-y: auto; overflow-x: hidden; ' > ";

                                foreach($messages as $message){
                                    if($message['role'] == 1){
                                        echo "<li class='clearfix'>
                                        <div class='message other-message float-right'> {$message['message']}</div>
                                    </li>";
                                    }
                                    else{
                                        echo "<li class='clearfix'>
                                        <div class='message my-message'>{$message['message']}</div>                                    
                                    </li> ";
                                    }
                                }
                                echo " 
                                </ul>
                            </div>
                            <form action = '' method = 'post' class='chat-message clearfix'>
                                <div class='input-group mb-0'>
                                <input type='text' class='form-control' placeholder='Enter text here...' name = 'message'>
                                <input type='hidden' class='form-control' placeholder='Enter text here...' name = 'id' value = '{$_GET['id']}'>
                                        <button type = 'submit' class='input-group-text'><i class='fa fa-send'></i></button>                                                                        
                                </div>
                            </form>";
                    } else{
                        echo "<div class='chat-history'>
                                <ul class='m-b-0'>
                                    
                                    <li class='clearfix'>
                                            <span class='message-data-time'>Select chat to show</span>                               
                                    </li>                               
                                    
                                </ul>
                            </div>
                            ";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
            window.onload = function() {
              const chatBody = document.getElementById("chatBody");
              chatBody.scrollTop = chatBody.scrollHeight; // Scroll to bottom
            };
          </script>

<?php include './includes/footer.php'; ?>