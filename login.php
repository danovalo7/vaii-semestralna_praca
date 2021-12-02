<?php
require "App.php";
$app = new App();
include "header.php";
$cpage = "login";
?>


<form name="form_login" method="post">
    <label for="user_name">username:</label>
    <input type="text" name="user_name" id="user_name"><label id="user_name_error" class="formerror"></label><br>
    <label for="user_pass">password:</label>
    <input type="text" name="user_pass" id="user_pass"><label id="user_pass_error" class="formerror"></label><br>
    <input type="submit" name="login" value="Login" id="login_button">
</form>


<script>
    function validateInput(element, validationFunction) {
        element.oninput = function (event) {
            let result = validationFunction(event.target.value);
            let errorElementID = element.id + "_error";
            let errorElement = document.getElementById(errorElementID);
            if (result == null) {
                errorElement.innerHTML = "";
            } else {
                errorElement.innerHTML = result;
            }
            document.getElementById("login_button").disabled = document.getElementById("user_name_error").innerHTML !== "" || document.getElementById("user_pass_error").innerHTML !== "";
        }
        element.dispatchEvent(new Event('input'));
    }

    window.onload = () => {
        validateInput(document.getElementById("user_name"), function (value = null) {
            if (value == null || value.length === 0) {
                return "Please enter a username.";
            }
        });

        validateInput(document.getElementById("user_pass"), function (value = null) {
            if (value == null || value.length === 0) {
                return "Please enter a password.";
            }
            if (value.length < 6) {
                return "Password must be at least 6 characters long.";
            }
        });
    };
</script>


<?php include "footer.php" ?>
