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
                        if (!empty($error_validation['email'])) {
                            echo "<div>" . $error_validation['email'] . "</div>";
                        }
                    ?>
                </div>
                <div>
                    <input type="text" name="username" class="default-input-registration"
                        style="font-family: 'Trebuchet MS';font-weight: 700" placeholder="username" required>
                    <div class="username-message">
                        <?php
                            if (!empty($error_validation['username'])) {
                                echo "<div>" . $error_validation['username'] . "</div>";
                            }
                        ?>
                    </div>
                </div>
                <input type="password" name="password" class="default-input-registration"
                    style="font-family: 'Trebuchet MS';font-weight:700" placeholder="password" required>
                <div class="password-message">
                    <?php
                        if (!empty($error_validation['password'])) {
                            echo "<div>" . $error_validation['password'] . "</div>";
                        }
                    ?>
                </div>
                <input type="password" name="confirmation_password" class="default-input-registration"
                    style="font-family: 'Trebuchet MS';font-weight: 700" placeholder="confirm password" required>
                <div class="confirmation-message">
                    <?php
                        if (!empty($error_validation['confirmation_password'])) {
                            echo "<div>" . $error_validation['confirmation_password'] . "</div>";
                            echo "<br>";
                            echo "<div>" . $error_validation['check_email'] . "</div>";
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