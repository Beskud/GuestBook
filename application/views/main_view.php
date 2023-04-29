<?php
session_start();
if (!isset($_SESSION['auth']) || $_SESSION['auth'] == false) {
    header("Location: http://guestbook/authorization");

}
?>

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
            <button class="circle" id="open-model-btn">
                <img src=<?php echo "/application/public/images/" . $_SESSION['user_data']['avatar_type'] . ".png" ?>
                    class="none-icon">
            </button>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Chose your avatar
            </button>




            <a href="http://guestbook/logout" style="  
                    margin-left: 10%;
                    text-decoration: none;
                    font-size: x-large;
                    font-family: monospace;
                    color: teal;
                    margin-left: 100px;">Logout</a>
        </div>
    </div>
</header>
<hr>

<div id="comment_container">

</div>


<div>
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



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Select avatar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="d-flex justify-content-between">
                    <img class="avatar-item p-2" id="4" src="/application/public/images/4.png" alt="">
                    <img class="avatar-item p-2" id="5" src="/application/public/images/5.png" alt="">
                    <img class="avatar-item p-2" id="6" src="/application/public/images/6.png" alt="">
                </div>
            </div>


            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>



</div>