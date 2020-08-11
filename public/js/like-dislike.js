$(document).ready(function () {
    $('.like-btn').on('click', function () {
        window.setTimeout('location.reload()', 100);
        var post_id = $(this).attr("data-id");
        $clicked_btn = $(this);
        if ($clicked_btn.hasClass('far')) {
            action = 'like';
        } else if ($clicked_btn.hasClass('fas')) {
            action = 'unlike';
        }
        $.ajax({
            url: 'livredor.php',
            type: 'post',
            data: {
                'action': action,
                'post_id': post_id
            },
            success: function (data) {
                res = JSON.stringify(data);
                if (action == 'like') {
                    $clicked_btn.removeClass('far');
                    $clicked_btn.addClass('fas');
                } else if (action == 'unlike') {
                    $clicked_btn.removeClass('fas');
                    $clicked_btn.addClass('far');
                }
                $clicked_btn.siblings('span.likes').text(res.likes);
                $clicked_btn.siblings('span.dislikes').text(res.dislikes);
                // change le style de l'icone si l'utilisateur réagit une deuxième fois au commentaire
                $clicked_btn.siblings('i.dislike').removeClass('fas').addClass('far');
            }
        });
    });
    $('.dislike-btn').on('click', function () {
        window.setTimeout('location.reload()', 100);
        var post_id = $(this).attr("data-id");
        $clicked_btn = $(this);
        if ($clicked_btn.hasClass('far')) {
            action = 'dislike';
        } else if ($clicked_btn.hasClass('fas')) {
            action = 'undislike';
        }
        $.ajax({
            url: 'livredor.php',
            type: 'post',
            data: {
                'action': action,
                'post_id': post_id
            },
            success: function (data) {
                res = JSON.stringify(data);
                if (action == 'dislike') {
                    $clicked_btn.removeClass('far');
                    $clicked_btn.addClass('fas');
                } else if (action == 'undislike') {
                    $clicked_btn.removeClass('fas');
                    $clicked_btn.addClass('far');
                }
                $clicked_btn.siblings('span.likes').text(res.likes);
                $clicked_btn.siblings('span.dislikes').text(res.dislikes);
                // change le style de l'icone si l'utilisateur réagit une deuxième fois au commentaire
                $clicked_btn.siblings('i.like').removeClass('fas').addClass('far');
            }
        });
    });
});