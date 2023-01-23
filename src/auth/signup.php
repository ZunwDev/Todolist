<?php
session_start();

if (isset($_SESSION['login_user'])) {
    header("location: ../index.php");
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="TodoList Test Application" content="Learning new stuff">
    <title>TodoList</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK REL=StyleSheet HREF="../stylesheet.css" TYPE="text/css" MEDIA=screen>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../src/js/auth_utils.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
</head>

<body class="flex w-screen h-screen bg-slate-100">
    <div class="app_appSignupFormContainer w-[24rem] mx-auto my-auto flex flex-col">
        <div class="app_appMoreInfoBox flex flex-col h-[6rem] my-auto shadow-xl rounded-t-lg" style="background-image: url('../assets/sign-up-background.webp')">
            <div class="flex flex-col w-full h-full text-white ml-8 my-6 pr-24">
                <div class="flex w-full text-4xl text-white h-12 font-bold">
                    Sign up
                </div>
            </div>
        </div>
        <form class="app_appSignupBox flex flex-col w-full bg-slate-100 shadow-lg rounded-b-lg" method="post">
            <div class="app_appSignupBoxCredentials flex flex-col w-[20rem] gap-3 my-auto mx-auto bg-slate-100">
                <div class="app_appFormField ml-2 mt-12 flex flex-col">
                    <input placeholder="Username" type="text" name="nameInput" id="nameInput" class="inputData shadow-md form-control block w-full px-4 py-2 text-lg font-normal text-gray-700 bg-slate-50 bg-clip-padding border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-slate-50 focus:border-blue-600 focus:outline-none" autocomplete="none">
                    <p id="usernameError" class="text-pink-500 mt-1 text-sm"></p>
                </div>
                <div class="app_appFormField ml-2 flex flex-col">
                    <input placeholder="Password" type="password" name="passwordInput" id="passwordInput" class="inputData shadow-md form-control block w-full px-4 py-2 text-lg font-normal text-gray-700 bg-slate-50 bg-clip-padding border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-slate-50 focus:border-blue-600 focus:outline-none" autocomplete="none">
                    <p id="passwordError" class="text-pink-500 mt-1 text-sm"></p>
                </div>
                <div class="app_appFormField ml-2 flex flex-col">
                    <input placeholder="Confirm Password" type="password" id="confPasswordInput" class="inputData shadow-md form-control block w-full px-4 py-2 text-lg font-normal text-gray-700 bg-slate-50 bg-clip-padding border border-solid border-gray-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-slate-50 focus:border-blue-600 focus:outline-none" autocomplete="none">
                    <p id="confPasswordError" class="text-pink-500 mt-1 text-sm"></p>
                </div>
            </div>
            <div class="app_appSignupBoxButtons flex flex-row mx-auto py-8 ">
                <button type="button" class="app_appSignupButton flex w-28 h-10 ml-16 my-auto bg-blue-600 hover:bg-blue-700 rounded-lg" onclick="signupCheckValues()">
                    <div class="mx-auto my-auto text-white">
                        Sign up
                    </div>
                </button>
                <div class="flex w-36 h-10 my-auto">
                    <div class="ml-2 my-auto text-white">
                        <span class="text-gray-700">or&nbsp</span><span class="text-blue-600 hover:text-blue-700"><a href="login.php">Log in</a></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(".inputData").on({
            keydown: function(e) {
                if (e.which === 32)
                    return false;
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });

        function checkUsername() {
            let usernameEl = document.getElementById("nameInput");
            let usernameVal = document.getElementById("nameInput").value;
            let usernameError = document.getElementById("usernameError");
            if (usernameVal.length < 4 || usernameVal.length > 30) {
                flagInput(usernameEl);
                showError(
                    usernameError,
                    "Your username should be within 4-30 characters"
                );
            } else {
                resetInput(usernameEl, usernameError);
                return true;
            }
        }

        function checkPassword() {
            let passwordEl = document.getElementById("passwordInput");
            let passwordVal = document.getElementById("passwordInput").value;
            let passwordError = document.getElementById("passwordError");
            if (passwordVal.length < 8) {
                flagInput(passwordEl);
                showError(passwordError, "Your password is too short");
            } else {
                resetInput(passwordEl, passwordError);
                return true;
            }
        }

        function checkConfirmPassword() {
            let confPassInputEl = document.getElementById("confPasswordInput");
            let passwordVal = document.getElementById("passwordInput").value;
            let confPassInputVal = document.getElementById("confPasswordInput").value;
            let confPasswordError = document.getElementById("confPasswordError");

            var isPassEqual = passwordVal === confPassInputVal;

            if (!isPassEqual || confPassInputVal.length === 0) {
                flagInput(confPassInputEl);
                showError(confPasswordError, "Password doesn't match");
            } else {
                resetInput(confPassInputEl, confPasswordError);
                return true;
            }
        }

        function userExists() {
            let usernameEl = document.getElementById("nameInput");
            let usernameError = document.getElementById("usernameError");

            flagInput(usernameEl);
            showError(usernameError, "User already exists");
        }

        function signupCheckValues() {
            if (
                checkUsername() && checkPassword() && checkConfirmPassword()
            ) {
                var username = $("#nameInput").val();
                var password = $("#passwordInput").val();
                $.post("./signup_script.php", {
                    nameInput: username,
                    passwordInput: password,
                }).done(function(data) {
                    if (data.includes("200"))
                        return setTimeout(function() {
                            window.location = "../index.php";
                        }, 1000);
                    if (data.includes("500")) return console.log("Server side issue");
                    if (data.includes("404")) return userExists();
                });
            }
        }
    </script>
</body>


</html>