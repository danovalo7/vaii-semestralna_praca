<?php
include "header.php";
$cpage = "login";
include "navbar.php";
?>


<form name="form_login" method="post" onsubmit="return validateForm()">
    <label for="user_name">username:</label>
    <input type="text" name="user_name" id="user_name"><br>
    <label for="user_pass">password:</label>
    <input type="text" name="user_pass" id="user_pass"><br>
    <input type="submit" name="login" value="Login">
</form>

<script>
    function validateForm() {
        let x = document.forms["form_login"]["user_name"].value;
        if (x === "") {
            alert("Missing username.");
            return false;
        }

        x = document.forms["form_login"]["user_pass"].value;
        if (x === "") {
            alert("Missing password.");
            return false;
        }

    }
</script>

<?php



include "footer.php" ?>
