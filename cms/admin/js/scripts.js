$(document).ready(function() {
    $('#selectAllBoxes').click(function() {
        if (this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function() {
                this.checked = false;
            });
        }
    });

    const div_box = "<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(div_box);
    $('#load-screen').delay(500).fadeOut(500, function() {
        $(this).remove(); 
    })

    //jquery for finding online user countn without refresh
    function loadUsersOnline() {
        $.get("user_functions.php?getOnlineUserCount=result", function(data){
            $(".users-online").text(data);
        });
    }

    setInterval(function(){
        loadUsersOnline();
    },500);

});

