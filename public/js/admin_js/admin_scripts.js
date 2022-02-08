$(document).ready(function () {

    $('#current_password').keyup(function () {
        var current_password = $('#current_password').val();

        $.ajax({
            type: 'post',
            url: 'check-current-password',
            data: {
                current_password: current_password
            },
            success: function (resp) {
                if (resp == "false") {
                    $('#checkCurrentPwd').html("<font color=red> Current Password is incorrect</font>");
                }
                else if (resp == "true") {
                    $('#checkCurrentPwd').html("<font color=green>Current Password is correct</font>");
                }
            },
            error: function () {
                alert("Error. Please check on current password API.");
            }
        })
    })
})
