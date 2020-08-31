$(document).ready(function(){

    //on click signup, hide login and show register form
    $("#signup").click(function() {
        $("#first").slideUp("slow", function() {
            $("#second").slideDown("slow");
        });
    });

    //on click signup, hide registration and show login form
    $("#signup").click(function() {
        $("#second").slideUp("slow", function() {
            $("#first").slideDown("slow");
        });
    });
});