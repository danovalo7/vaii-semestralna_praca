<?php
require "App.php";
$app = new App();
include "header.php";
$cpage = "change_password";
include "navbar.php";
if (!$_SESSION['logged_in']) {exit("You are not logged in.");}
?>


<form name="form_change_password" method="post">
    <label for="user_old_pass">Old password:</label>
    <input type="text" name="user_old_pass" id="user_old_pass"><label id="user_old_pass_error" class="formerror"></label><br>
    <label for="user_pass">New password:</label>
    <input type="text" name="user_pass" id="user_pass"><label id="user_pass_error" class="formerror"></label><br>
    <label for="user_pass_again">New password again:</label>
    <input type="text" name="user_pass_again" id="user_pass_again"><label id="user_pass_again_error" class="formerror"></label><br>
    <input type="submit" name="change_password" value="Change password" id="change_password_button">

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
            document.getElementById("change_password_button").disabled = document.getElementById("user_old_pass_error").innerHTML !== "" || document.getElementById("user_pass_error").innerHTML !== "" || document.getElementById("user_pass_again_error").innerHTML !== "";
        }
        element.dispatchEvent(new Event('input'));
    }

    window.onload = () => {

        validateInput(document.getElementById("user_old_pass"), function (value = null) {
            if (value == null || value.length === 0) {
                return "Please enter your password.";
            }
            if (value.length < 6) {
                return "Password must be at least 6 characters long.";
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
        validateInput(document.getElementById("user_pass_again"), function (value = null) {
            if (value == null || value.length === 0) {
                return "Please re-enter the above password.";
            }
            if (document.getElementById("user_pass").value !== value) {
                return "Passwords do not match.";
            }
        });
    };
</script>


<?php include "footer.php" ?>
