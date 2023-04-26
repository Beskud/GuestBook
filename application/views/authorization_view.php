<body style="background-color: slategray">
<div class="container">
    <form action="authorization/authorization" method="POST">
        <h3 style="text-align: center; color: #ffff; font-weight: 700; font-size: 30px; font-family: 'Trebuchet MS';">
            Authorization</h3>
        <div class="position-registr">
            <input type="email" name="email" class="default-input-registration"
                style="-family: 'Trebuchet MS'; font-weight: 700" placeholder="email" required>
            <input type="password" name="password" class="default-input-autorization"
                style="font-family: 'Trebuchet MS';font-weight:700" placeholder="password" required>
            <div class="message">
                <?php
                    if (!empty($error)) {
                        echo "<div>" . $error . "</div>";
                    }
                ?>
            </div>
            <input id='click' type="submit" name="submitButton" class="registration-button">
            <br>
        </div>
    </form>
    <div class="position-registr">
        <a href="http://guestbook/registration" class="nav_livk">Еще не зарегистрированы?</a>
    </div>
</div>
</body>