
    function showProfileMenu() {
        var profileMenu = document.getElementById("profile_dropdown");
        if (profileMenu.style.display == "none") {
            profileMenu.style.display = "block";
        } else {
            profileMenu.style.display = "none";
        }
    };
    
    
    function closeProfileMenu() {
        var profileMenu = document.getElementById("profile_dropdown");
        if (profileMenu !== null) {
            if (profileMenu.style.display == "block") {
                profileMenu.style.display = "none";
            }
        }
    }
    
    function userLogOut() {
        $.post("./auth/log_out.php", {});
        window.location = "./index.php";
    }
