<?php
require "App.php";
$app = new App();
include "header.php";
$cpage = "register";
include "navbar.php";
?>

    <form method="post">
        <label for="user_name">username:</label><input type="text" name="user_name" id="user_name"><br>
        <label for="user_pass">password:</label>
        <input type="text" name="user_pass" id="user_pass"><br>
        <label for="user_email">email:</label>
        <input type="text" name="user_email" id="user_email"><br>
        <input type="submit" name="register" value="Register">
    </form>

    <script>
        function validateForm() {
            let x = document.forms["registration_form"]["username"].value;
            if (x == "") {
                alert("Username must be filled out");
                return false;
            }

            x = document.forms["registration_form"]["password"].value;
            if (x == "") {
                alert("Password must be filled out");
                return false;
            }

            x = document.forms["registration_form"]["email"].value;
            if (x == "") {
                alert("Email must be filled out");
                return false;
            }
        }
    </script>
<?php include "footer.php"; ?>