<?php
require "App.php";
$app = new App();
include "header.php";
$cpage = "delete_account";
include "navbar.php";
if (!$_SESSION['logged_in']) {exit("You are not logged in.");}
?>

<h1>THIS WILL PERMANENTLY DELETE YOUR ACCOUNT. THIS CANNOT BE UNDONE. ARE YOU SURE?</h1>
<form name="form_delete_account" method="post">
    <label for="user_pass">Confirm with password:</label>
    <input type="text" name="user_pass" id="user_pass"><label id="user_pass_error" class="formerror"></label><br>
    <input type="submit" name="delete_account" value="DELETE ACCOUNT" id="delete_account_button">
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
            document.getElementById("change_password_button").disabled = document.getElementById("user_pass_error").innerHTML !== "";
        }
        element.dispatchEvent(new Event('input'));
    }

    window.onload = () => {

        validateInput(document.getElementById("user_pass"), function (value = null) {
            if (value == null || value.length === 0) {
                return "Please enter your password.";
            }
            if (value.length < 6) {
                return "Password must be at least 6 characters long.";
            }
        });
    };
</script>


<?php include "footer.php" ?>
