$(document).ready(function () {
    $('.open-hymn').on('click', function(e) {
        e.preventDefault();

        var $link = $(e.currentTarget);
        // $link.toggleClass('fa-heart-o').toggleClass('fa-heart');

        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function (data) {

            $('.js-open-hymn').html(data.aHymn);

        });

        // $('.js-like-article-count').html('TEST');
    });
});

$(document).ready(function () {
    $('.js-like-article').on('click', function(e) {
        e.preventDefault();

        var $link = $(e.currentTarget);
        $link.toggleClass('fa-heart-o').toggleClass('fa-heart');

        $.ajax({
            method: 'POST',
            url: $link.attr('href')
        }).done(function (data) {

            $('.js-like-article-count').html(data.hearts);

        });

        $('.js-like-article-count').html('TEST');
    });
});