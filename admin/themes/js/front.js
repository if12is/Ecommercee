$(function () {
    // Dashboard Toggle 
    $('.toggle_info').click(function () {
        $(this).toggleClass('selected').parent().next('.card-body').fadeToggle(150);
        if ($(this).hasClass('selected') ) {
            console.log("ok")
            $(this).children('.fa-plus').removeClass('fa-plus').addClass('fa-minus');
        }else {
            $(this).children('.fa-minus').removeClass('fa-minus').addClass('fa-plus');
        }
    })

    $('[placeholder]').focus(function () {
        $(this).attr('data-text' , $(this).attr('placeholder')); 
        $(this).attr('placeholder', '');
    });
    $('[placeholder]').blur(function () {
        $(this).attr('placeholder', $(this).attr('data-text'));
    });

    $('input').each(function () {
        if ($(this).attr('required') === 'required') {
            $(this).before('<span class="imp_star"> * </span>')
        }
    });

    $('.show-pass').hover(function () {
        // console.log('showing');
        $('.password').attr('type','text');
    },function () {
        $('.password').attr('type','password');
    });

    $('.confirm').click(function () {
        return confirm('Are you sure you want to Delete this User');
    });
    
    $(".cat h3").click(function () {
        // console.log('showing');
        $(this).next(".full_view").fadeToggle(400);
    });

})