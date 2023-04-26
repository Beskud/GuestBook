<?php
session_start();
if (!isset($_SESSION['auth']) || $_SESSION['auth'] == false) {
    header("Location: http://guestbook/authorization");

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site</title>
</head>

<body>


    <header>
        <div style='display:flex;align-items:center;'>
            <img src="https://www.veryicon.com/download/png/internet--web/iview-3-x-icons/logo-apple?s=256"
                style="width: 52px;">
                
            <div style='display:flex; margin-left: 40px;'>
                <input class="search" type="search" placeholder="Search" style="width: 300px;height: 50px;">
                <input class="search-button" type="button" style="width: 70px;height: 50px; padding-left: 35px;">
            </div>
            <div style="display: flex;
            align-items: baseline;
            color: teal;
            font-family: monospace;
            margin-left: 50%;">

                <h3>
                    <?php
                    session_start();
                    if ($_SESSION['auth']) {
                        echo $_SESSION['user_data']['username'];
                    } else {
                        echo '<a href="http://guestbook/authorization" style="  
                        margin-left: 20%;
                        text-decoration: none;
                        font-size: xx-large;
                        font-family: monospace;
                        color: teal;">Authorization</a>
                        <a href="http://guestbook/registration" style="  
                        margin-left: 10%;
                        text-decoration: none;
                        font-size: xx-large;
                        font-family: monospace;
                        color: teal;">Registration</a>';
                    }
                    ?>
                </h3>

                <a href="http://guestbook/logout" style="  
                    margin-left: 10%;
                    text-decoration: none;
                    font-size: x-large;
                    font-family: monospace;
                    color: teal;">Logout</a>
            </div>

        </div>
    </header>
    <hr>

    <div style="display:flex;align-items:center;">
        <img src="https://yabloki.ua/media/cache/resolve/app_product_page_small_slider_image/c5/83/2eb34144f337e28d54d5894eb33f.png"
            style="width: 500px;">

    </div>


    <div>
        <p>
            <label>Имя:</label>
            <input id="user" type="text" name="username" style="width: 20%;border-color:black" required />
        </p>
        <p>
            <label>Комментарий:</label>
            <br />
            <textarea id="text" name="text_comment" cols="30" rows="50"
                style="width: 475px;height: 110px;border-color:black" required></textarea>
            <br />
            <button id="button-js"
                style="width: 100px;height: 30px;background-color:teal;border-radius:7px;border-color: cadetblue;font-family: monospace;font-size: 14px;">Отправить</button>
    </div>
    <hr>
    </div>
    </div>

</body>
<script src="/application/Public/Scripts/script_comm.js"></script>
</html>