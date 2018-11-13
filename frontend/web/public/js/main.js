// Добавление в корзину
var addMess = function (){
    if ($('p').hasClass('profile_save')){
        $('.profile_save').html('Товар добавлен в корзину').fadeIn(600);
    }else {
        $('body').prepend($('<p />').addClass('profile_save').html('Товар добавлен в корзину'));
    }
    setTimeout(function () {
        $('.profile_save').fadeOut(600);
    }, 600);
};
$('.main').on('click','.kit__inCart',function (ev) {
    ev.preventDefault();
    var id = $(this).data('id');
    var qty = parseInt($($(this).data('count_id')).text());
    var $fa = $(this).children('.fa');
    if ($fa.hasClass('fa-spinner')){
        return false;
    }
    $fa.removeClass('fa-shopping-cart').addClass('fa-spinner fa-pulse');
    $.ajax({
        type:'get',
        url:'/cart/add',
        data:{
            id:id,
            qty:qty
        },
        dataType:'json',
        success:function (data) {
            $('.cart_counter').text(data);
            setTimeout(function () {
                $fa.removeClass('fa-spinner fa-pulse').addClass('fa-shopping-cart');
                addMess();
            },500);
        }
    });
});

// Удаление из корзины
$('.main').on('click','.del_cart_item',function (ev) {
    ev.preventDefault();
    var id = $(this).data('del');
    $.ajax({
        type:'get',
        url:'/cart/del',
        data:{
            id:id
        },
        dataType:'json',
        success:function (data) {
            $('.cart_wrapper').replaceWith(data.view);
            $('.cart_counter').text(data.counter);
        }
    })
});

// Изменение количества товара
var btn = jQuery('.counter__btn');

$('.main').on('click','.counter__btn', function() {
    var inp = $($(this).data('id'));
    var qnt = parseInt(inp.text());
    switch (jQuery(this).attr('data-act')){
        case 'up':
            qnt += 1;
            break;
        case 'down':
            qnt=(inp.text()<=1)?qnt-=0:qnt-=1;
    }
    inp.text(qnt);

    if($(this).hasClass('cart_btn')){
        var id = $(this).data('prod_id');
        var qty = parseInt($($(this).data('id')).text());
        $.ajax({
            type:'get',
            url:'/cart/change',
            data:{
                id:id,
                qty:qty
            },
            dataType:'json',
            success:function (data) {
                console.log(data);
                $('.cart_wrapper').replaceWith(data.view);
                $('.cart_counter').text(data.counter);
            }
        })
    }
});

$('.product__image').fancybox({
    buttons : false
});

//Всплывающие окна
if($('#flash_message').length){
    $.fancybox.open({
        type : 'inline',
        src:'#flash_message'
    });
}

// $('.main').on('click','.pagination a',function () {
//    var offset = $('.site_header').offset().top;
//     $('html, body').animate({ scrollTop: offset }, 500);
// });

//Разворачивание списка заказов
$('.order_prod_count').on('click',function () {
    $(this).siblings('ul').slideToggle('fast');
});

//Изчезновение сообщения в ЛК
setTimeout(function () {
    $('.profile_save').fadeOut(1000);
},3000);

//Маска для телефонов
$(".phone_mask").mask("+7 (999) 999-9999");


//Мобильное меню

function closeMenu() {
    $('.mobile_menu').hide('drop');
    $('.wrapper').removeClass('panel-open');
    $('body').css('overflow','auto');
}

$('.btn_mobile').on('click',function () {
    $('.mobile_menu').show('drop');
    $('.wrapper').addClass('panel-open');
    $('body').css('overflow','hidden');
});

$('.close_menu').on('click',function () {
    closeMenu();
    return false;
});

$(document).on('click',function (ev) {
    if ($('.wrapper').hasClass('panel-open')){
        if($(ev.target).closest('.mobile_menu').length || $(ev.target).closest('.btn_mobile').length){
            return;
        }
        closeMenu();
    }
    ev.stopPropagation();
});

$('.mobile_menu .parent').on('click',function () {
    $(this).siblings('.child_menu').css('display','block');
    $('.mob_menu_back').css('display','block');
    return false;
});

$('.mob_menu_back').on('click',function () {
    $(this).css('display','none');
    $('.child_menu').css('display','none');
});

//Мобильное меню END

//Поиск
$('.search_icon').on('click',function () {
    $(this).hide('fade', function () {
        $('.search_icon_close').show('fade');
    });
    $('.searchBlockWrap').addClass('open');
    $('.search_form').show('drop',{direction:'right'});
    $('.search_form input').focus();
    $('.hideMenu').hide('drop');
    return false;
});

$('.search_icon_close').on('click',function () {
    $(this).hide('fade', function () {
        $('.search_icon').show('fade');
    });
    $('.searchBlockWrap').removeClass('open');
    $('.search_form').hide('drop',{direction:'right'});
    $('.hideMenu').show('drop', function () {
        $(this).css('display', 'flex');
    });

    return false;
});
//Поиск END

//Скрол до блока кухни
function scrollToBlock(linkClass,to) {
    $(linkClass).on('click',function () {
        var toOffset = $(to).offset().top;
        $('html, body').animate({ scrollTop: toOffset }, 600);
        return false;
    })
}
scrollToBlock('.menu_btn_scroll','.kitchen_block');


//slick
var slickBlock = $('.slickBlock');
var margin = '';

function runSlick() {
    if ($(window).width() < 570) {
        $(window).width() < 570
            ? margin = '0'
            : margin = '-21px';
        slickBlock.css('margin-right', margin);
        if (!slickBlock.hasClass('slick-initialized')) {
            slickBlock.slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: false,
                infinite: false,
                variableWidth: true,
                prevArrow: '<button type="button" class="fa fa-angle-left comment__slickBtn"></button>',
                nextArrow: '<button type="button" class="fa fa-angle-right comment__slickBtn"></button>',
                appendArrows: $('.slick__nav'),
                // responsive: [
                //     {
                //         breakpoint: 670,
                //         settings: {
                //             slidesToShow: 1,
                //             slidesToScroll: 1,
                //             dots: true,
                //             arrows: false,
                //             variableWidth: false,
                //             dotsClass: 'comment__dots',
                //             infinite: false
                //         }
                //     }
                // ]
            });
        }
    }
    else if (slickBlock.hasClass('slick-initialized')) {
        slickBlock.removeAttr('style');
        slickBlock.slick('unslick');
    }
}

runSlick();

$(window).resize(runSlick);

//Боковое меню
$('.menu_side .parent').on('click',function () {
    $('.menu_side .active').removeClass('active');
    $(this).parent('li').addClass('active');
    $(this).siblings('.child').slideToggle('fast');
    return false;
});
$('.category_show').on('click',function () {
    $('.side_menu_wrapper').slideToggle('fast');
    ev.preventDefault();
    return false;
});

//Слайдер
$('.mainSlider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows:false,
    autoplay:true,
    lazyLoad: 'progressive',
    autoplaySpeed:5000,
    fade:true,
    speed:1000,
    dots: true


});
//     .on('beforeChange',function (event, slick, currentSlide, nextSlide) {
//     $("[data-slick-index = "+currentSlide+"] .main_header_block").fadeOut();
//     console.log(currentSlide);
//     console.log(nextSlide);
// });

function openInfo(hiddenClass) {
    $(hiddenClass).slideToggle('fast');
}
$('.button_more_cm').on('click',function () {
    openInfo('.hidden_cat');
    $(this).children('.down-icon').toggleClass('icon_up');
});

// leftMenuCategory
var $openCat = $('.openCat');

$('.openArrow').on('click', function () {
    $(this).hide('fold', 600, function () {
        $openCat.prepend('<li class="temp"></li>');
        $openCat.addClass('open').show('fold', 600);
    });
});

$(document).on('click', function (event) {
    if ($openCat.hasClass('open')){
        if ($(event.target).closest(".openCat").length
            || $(event.target).closest(".openArrow").length) {
            return;
        }
        $openCat.hide('fold', 600, function () {
            $(this).removeClass('open');
            $(this).find('.temp').remove();
            $('.openArrow').show('fold', 600);
        });
    }
    event.stopPropagation();
});
//buttonUp
$(window).scroll(function () {
    if ($(this).scrollTop() > 200) {
        $('#buttonUp').fadeIn().addClass('active');
    } else {
        $('#buttonUp').fadeOut().removeClass('active');
    }
});
$('#buttonUp').click(function () {
    $('body,html').animate({
        scrollTop: 0
    }, 500);
    return false;
});
//endButtonUp
