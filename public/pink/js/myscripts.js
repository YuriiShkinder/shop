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
                    }else {
                        $('.wrap_result').append('<br/><strong>Сохранино .Ваш комментарий на обработке</strong>').delay(2000).fadeOut(500);

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

    $('#closeOverlay').click(function () {
        $('#overlay').hide();
    })

function like(likes,dislike,url,str){
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        data: {
            str: str
        },
        success: function (msg) {
            likes.text('+'+msg.like);
            dislike.text('-'+msg.dislike);
        }
    })
}
    $('.like').click(function () {
        url=$(this).attr('url');
        likes=$(this);
        dislike=likes.siblings('.dislike');
        str='like';
        like(likes,dislike,url,str);
    })

    $('.dislike').click(function () {
        url=$(this).attr('url');
        dislikes=$(this);
        likes=dislikes.siblings('.like');
        console.log(dislike);
        str='dislike';
        like(likes,dislike,url,str);
    })

    $('#pagination').click(function () {
        $('.subPagin').slideToggle();
    })


    $('#search').keyup(function (e) {
        var str=$(this).val();

        if(str.length>=2) {
            url = $(this).parent('form').attr('action');

            $.ajax({
                url: url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: {
                    str: str
                },

                success: function (msg) {
                    if(msg.success){
                        $('#searchLi').children('ul').detach();
                        $('#searchLi').append(msg.content);
                    }
                }
            })
        }else {
            $('#searchLi').children('ul').detach();

        }
    })
    $(document).click(function (e){
        var div = $("#searchLi ul");
            $('#search').val('');
            div.hide();

    });

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
        $('#modal_form').animate({opacity: 0, top: '45%'}, 200,
                function(){ // пoсле aнимaции
                    $(this).css('display', 'none');
                    $('#overlay').fadeOut(400);
                }
            );
    });
});