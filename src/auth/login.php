<?php
session_start();

if (isset($_SESSION['login_user'])) {
    header("location: https://xtodolist.tode.cz/index.php");
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" name="TodoList Test Application" content="Learning new stuff">
    <title>TodoList</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <LINK REL=StyleSheet HREF="../../stylesheet.css" TYPE="text/css" MEDIA=screen>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="../js/auth_utils.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
</head>

<body class="flex w-screen h-screen bg-slate-100">
    <div class="app_appSignupFormContainer w-[24rem] mx-auto my-auto flex flex-col">
        <div class="app_appMoreInfoBox flex flex-col h-[6rem] my-auto shadow-xl rounded-t-lg" style="background-image: url('../../assets/login-background.webp')">
            <div class="flex flex-col w-full h-full text-white ml-8 my-6 pr-24">
                <div class="flex w-full text-4xl text-gray-600 h-12 font-bold">
                    Log in
                </div>
            </div>
        </div>
        <form class="app_appSignupBox flex flex-col w-full bg-slate-100 shadow-lg rounded-b-lg" method="post">
            <div class="app_appSignupBoxCredentials flex flex-col w-[20rem] gap-3 my-auto mx-auto bg-slate-100">
                <div class="app_appFormField ml-2 mt-12 flex flex-col">
                    <input placeholder="Username" type="text" name="nameInput" id="nameInput" class="inputData shadow-md form-control block w-full px-4 py-2 text-lg font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-slate-50 focus:border-blue-600 focus:outline-none" autocomplete="none">
                    <p id="usernameError" class="text-pink-500 mt-1 text-sm"></p>
                </div>
                <div class="app_appFormField ml-2 flex flex-col">
                    <input placeholder="Password" type="password" name="passwordInput" id="passwordInput" class="inputData shadow-md form-control block w-full px-4 py-2 text-lg font-normal text-slate-700 bg-slate-50 bg-clip-padding border border-solid border-slate-300 rounded-md transition ease-in-out m-0 focus:text-gray-700 focus:bg-slate-50 focus:border-blue-600 focus:outline-none" autocomplete="none">
                    <p id="passwordError" class="text-pink-500 mt-1 text-sm"></p>
                </div>
            </div>
            <div class="app_appSignupBoxButtons flex flex-row mx-auto py-8">
                <button type="button" class="app_appSignupButton flex w-28 h-10 ml-16 my-auto bg-slate-600 hover:bg-slate-700 rounded-lg">
                    <div class="mx-auto my-auto text-white" onclick="logIn()">
                        Log in
                    </div>
                </button>
                <div class="flex w-36 h-10 my-auto">
                    <div class="ml-2 my-auto text-white">
                        <span class="text-slate-700">or&nbsp</span><span class="text-slate-600 hover:text-slate-700"><a href="signup.php">Sign up</a></span>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function passwordVerifyFailed() {
            const passwordEl = document.getElementById('passwordInput');
            const passwordError = document.getElementById('passwordError');

            flagInput(passwordEl);
            showError(passwordError, 'Incorrect password');
        }

        function passwordOrUsernameIncorrect() {
            const passwordEl = document.getElementById('passwordInput');
            const passwordError = document.getElementById('passwordError');
            const usernameEl = document.getElementById('nameInput');
            const usernameError = document.getElementById('usernameError');
            flagInput(passwordEl);
            showError(passwordError, 'Incorrect password');
            flagInput(usernameEl);
            showError(usernameError, "User doesn't exist/invalid username");

        }

        function userDoesntExist() {
            const usernameEl = document.getElementById('nameInput');
            const usernameError = document.getElementById('usernameError');

            flagInput(usernameEl);
            showError(usernameError, "User doesn't exist/invalid username");
        }

        function successfulLogin() {
            resetInput(document.getElementById('nameInput'), document.getElementById('usernameError'));
            resetInput(document.getElementById('passwordInput'), document.getElementById('passwordError'));
            setTimeout(() => {
                window.location = '../index.php';
            }, 500);
        }

        function logIn() {
            $.post('https://xtodolist.tode.cz/src/auth/login_script.php', {
                nameInput: $('#nameInput').val(),
                passwordInput: $('#passwordInput').val(),
            }).done((data) => {
                //console.log(data);
                if (data.includes("200")) {
                    successfulLogin();
                } else if (data.includes("401")) {
                    passwordOrUsernameIncorrect();
                } else if (data.includes("403")) {
                    resetInput(document.getElementById('nameInput'), document.getElementById('usernameError'));
                    passwordVerifyFailed();
                } else if (data.includes("404")) {
                    userDoesntExist();
                }
            });
        }

        $(".inputData").on({
            keydown: function(e) {
                if (e.which === 32)
                    return false;
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });
    </script>
</body>