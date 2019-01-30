$(document).ready(function() {
    $('button').click(function() {
        var route = $(this).data('value');
        $.ajax({
            url: `index/detailsAjax/${route}`,
            success: function(res) {
                console.log(res);
                var user = JSON.parse(res);
                alert(
                    `User Id: ${user[0].UserId}\nUser Name: ${user[0].UserName}\nUser Email: ${user[0].UserEmail}\n`
                )
            },
            error: function(a, b, c) {
                console.log(a);
            }
        })
    });
});