jQuery(document).ready(function($) {

    $('.commentlist li').each(function (i) {

        $(this).find('div.commentNumber').text('#' + (i + 1));

    });

    $('#commentform').on('click', '#submit', function (e) {

        e.preventDefault();

        var comParent = $(this);

        $('.wrap_result').css('color', 'green').text('Сохранение комментария').fadeIn(500, function () {

            var data = $('#commentform').serializeArray();

            $.ajax({

                url: $('#commentform').attr('action'),
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                datatype: 'JSON',
                success: function (html) {
                    if (html.error) {
                        $('.wrap_result').css('color','red').append('<br><strong>Ошибка:</strong>'+ html.error.join('<br>'));
                        $('.wrap_result').delay(2000).fadeOut(200);
                    } else if (html.success) {
                        $('.wrap_result').append('<br/><strong>Сохранино</strong>').delay(2000).fadeOut(500, function () {
                            if (html.data.parent_id > 0) {
                                comParent.parents('div#respond').prev().after('<ul class="children">' + html.comment + '</ul>');

                            } else {
                                if ($.contains('#comments', 'ol.commentlist')) {
                                    $('ol.commentlist').append(html.comment);
                                } else {
                                    $('#respond').before('<ol class="commentlist group">'+ html.comment+'</ol>');
                                }
                            }
                            $('#cancel-comment-reply-link').click();
                        });
                    }

                },
                error: function () {
                    $('.wrap_result').css('color','red').append('<br><strong>Ошибка:</strong>');
                    $('.wrap_result').delay(2000).fadeOut(500,function () {
                        $('#cancel-comment-reply-link').click();
                    });
                }
            });

        });

    });
});

jQuery(document).ready(function ($) {

    $('.cartOrder').click(function (e) {
        e.preventDefault();
        val= parseInt($('.cartUser').children('span').first().text()) ? parseInt($('.cartUser').children('span').first().text()) : 0 ;
        val++;
        $('.cartUser').children('span').first().text(val);
        data={article_id: $(this).attr('id'),count:val};

        $.ajax({
            url:$(this).attr('url'),
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            datatype: 'JSON',
            success: function (html) {
                if (html.error) {
                    $('.wrap_result').css('color','red').append('<br><strong>Ошибка:</strong>'+ html.error.join('<br>'));
                    $('.wrap_result').delay(2000).fadeOut(200);

                } else if (html.success) {
                    console.log(222);
                    $('.wrap_result').children().detach();
                    // $('.wrap_result').children('strong').detach('strong');
                    $('.wrap_result').css('display','block').append('<br/><strong>Товар добавлено в корзину</strong>').delay(2000).fadeOut(500);

                }
            },
            error: function () {
                $('.wrap_result').css('color','red').append('<br><strong>Ошибка:</strong>');
                $('.wrap_result').delay(2000).fadeOut(500);
            }
        });

    })
// пароль
    $('#formPass').on('click','#resetPass',function (e) {
        e.preventDefault();

        $('.wrap_result').css('color', 'green').text('Сохранение пароля').fadeIn(500, function () {

            var data = $('#formPass').serializeArray();

            $.ajax({

                url: $('#formPass').attr('action'),
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                datatype: 'JSON',
                success: function (html) {
                    if (html.error) {
                        $('.wrap_result').css('color','red').append('<br><strong>Ошибка:</strong>'+ html.error.join('<br>'));
                        $('.wrap_result').delay(2000).fadeOut(200);

                    } else if (html.success) {
                        $('.wrap_result').append('<br/><strong>Сохранино</strong>').delay(2000).fadeOut(500,function () {
                            $('#modal_form,#modal_close, #overlay').fadeOut(400);
                        });
                    }
                },
                error: function () {
                    $('.wrap_result').css('color','red').append('<br><strong>Ошибка:</strong>');
                    $('.wrap_result').delay(2000).fadeOut(500);
                }
            });

        });


    })

});







jQuery(document).ready(function($) {
    $('#go').click( function(event){
        event.preventDefault();
        $('#overlay').fadeIn(400,
            function(){
                $('#modal_form')
                    .css('display', 'block')
                    .animate({opacity: 1, top: '50%'}, 200);
            });
    });

    $('#modal_close, #overlay').click( function(){
        $('#modal_form')
            .animate({opacity: 0, top: '45%'}, 200,
                function(){ // пoсле aнимaции
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
    });
});