<?php
require "App.php";
$app = new App();
include "header.php";
$cpage = "register";
include "navbar.php";
?>

    <form name="form_register" method="post" onsubmit="return validateForm()">
        <label for="user_email">email:</label>
        <input type="text" name="user_email" id="user_email"><br>
        <label for="user_name">username:</label>
        <input type="text" name="user_name" id="user_name"><br>
        <label for="user_pass">password:</label>
        <input type="text" name="user_pass" id="user_pass"><br>
        <input type="submit" name="register" value="Register">
    </form>

    <script>
        function validateForm() {
            let x = document.forms["form_register"]["user_name"].value;
            if (x === "") {
                alert("Missing username.");
                return false;
            }

            x = document.forms["form_register"]["user_pass"].value;
            if (x === "") {
                alert("Missing password.");
                return false;
            }

            x = document.forms["form_register"]["user_email"].value;
            if (x === "") {
                alert("Missing email.");
                return false;
            }
        }
    </script>
<?php include "footer.php"; ?>