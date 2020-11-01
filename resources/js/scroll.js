var offsetValue = 100;
var navBarHeight = $('nav.navbar').outerHeight();
var positionFromTop = $(window).scrollTop();

$(window).scroll(function () {
    positionFromTop = $(window).scrollTop();
    setNavBar();
});

$(window).resize(function () {
    navBarHeight = $('nav.navbar').outerHeight();
    offsetValue = navBarHeight;
});

setNavBar();

function setNavBar() {
    if (positionFromTop > 40) {
        $('nav.navbar').css('position', 'fixed');
        $('#navbar-helper').css('height', navBarHeight);
    }
    else {
        $('nav.navbar').css('position', 'relative');
        $('#navbar-helper').css('height', '0');
    }
}

$('body').scrollspy({
    target: '#navbar',
    offset: offsetValue + 1,
});

$('ul.navbar-nav').find('a').click(function () {
    let target = $(this).data('target');
    if (target !== undefined) {
        return true;
    }
    target = $(this).attr('href');
    const anchor = $(target).offset();

    $('html,body').animate({
        scrollTop: anchor.top - offsetValue,
    });

    return false;
});
