<?php
require "App.php";
$app = new App();
include "header.php";
$cpage = "register";
include "navbar.php";
?>

    <form name="form_register" method="post">
        <label for="user_email">email:</label>
        <input type="text" name="user_email" id="user_email"><label id="user_email_error" class="formerror"></label><br>
        <label for="user_name">username:</label>
        <input type="text" name="user_name" id="user_name"><label id="user_name_error" class="formerror"></label><br>
        <label for="user_pass">password:</label>
        <input type="text" name="user_pass" id="user_pass"><label id="user_pass_error" class="formerror"></label><br>
        <input type="submit" name="register" value="Register" id="register_button">
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
                document.getElementById("register_button").disabled = document.getElementById("user_name_error").innerHTML !== "" || document.getElementById("user_pass_error").innerHTML !== "" || document.getElementById("user_email_error").innerHTML !== "";
            }
            element.dispatchEvent(new Event('input'));
        }

        window.onload = () => {
            validateInput(document.getElementById("user_name"), function (value = null) {
                if (value == null || value.length === 0) {
                    return "Please enter a username.";
                }
            });
            validateInput(document.getElementById("user_email"), function (value = null) {
                if (value == null || value.length === 0) {
                    return "Please enter an email.";
                }
                let re = new RegExp('^\\S+@\\S+\\.\\S+$');
                if (!re.test(value)) {
                    return "This is not a valid email.";
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


<?php include "footer.php"; ?>