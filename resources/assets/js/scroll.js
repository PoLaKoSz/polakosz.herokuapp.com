var offsetValue = 100;
var navBarHeight = $('nav.navbar').outerHeight();
var positionFromTop = $(window).scrollTop();

$(window).scroll(function () {
    positionFromTop = $(window).scrollTop();
    setNavBar();
});

$(window).resize(function () {
    navBarHeight = $('nav.navbar').outerHeight();
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
    offset: offsetValue,
});

$('ul.nav').find('a').click(function () {
    var $href = $(this).attr('href');

    var $anchor = $($href).offset();

    $('body').animate({
        scrollTop: $anchor.top - offsetValue
    });

    return false;
});