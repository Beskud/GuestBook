
<div class="container">
    <form action="registration/registration" method="POST">
        <h3 style="text-align: center; color: #ffff; font-weight: 700; font-size: 30px; font-family: 'Trebuchet MS';">
            Registration</h3>
        <div class="position-registr">
            <div>
                <input type="email" name="email" class="default-input-registration"
                    style="font-family: 'Trebuchet MS'; font-weight: 700" placeholder="email" required>
                <div class="email-message">
                    <?php
                        if (!empty($_SESSION['error']['email'])) {
                            echo $_SESSION['error']['email'];
                        }
                    ?>
                </div>
                <div>
                    <input type="text" name="username" class="default-input-registration"
                        style="font-family: 'Trebuchet MS';font-weight: 700" placeholder="username" required>
                    <div class="username-message">
                        <?php
                            if (!empty($_SESSION['error']['username'])) {
                                echo $_SESSION['error']['username'];
                            }
                        ?>
                    </div>
                </div>
                <input type="password" name="password" class="default-input-registration"
                    style="font-family: 'Trebuchet MS';font-weight:700" placeholder="password" required>
                <div class="password-message">
                    <?php
                        if (!empty($_SESSION['error']['password'])) {
                            echo $_SESSION['error']['password'];
                        }
                    ?>
                </div>
                <input type="password" name="confirmation_password" class="default-input-registration"
                    style="font-family: 'Trebuchet MS';font-weight: 700" placeholder="confirm password" required>
                <div class="confirmation-message">
                    <?php
                        if (!empty($_SESSION['error']['confirmation_password'])) {
                            echo $_SESSION['error']['confirmation_password'];
                            echo "<br>";
                            echo $_SESSION['error']['check_email'];
                        }
                    ?>
                </div>
                <input id='click' type="submit" name="submitButton" class="registration-button">
            </div>
    </form>
    <br>
    <div class="position-registr">
        <a href="http://guestbook/authorization" class="nav_livk">Уже зарегистрированы?</a>
    </div>
</div>

<?php
    if(!empty($_SESSION['error'])) session_unset();
?>