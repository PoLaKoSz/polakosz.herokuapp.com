$('input[type="checkbox"]').on('change', function() {
    $(this).closest('fieldset').find('.hideshow').toggle(!this.checked);
});

function BootstrapDropDown(containerName) {
    var button = $(containerName + ' button#dropdownMenu');
    var listItem = $(containerName + ' ul.dropdown-menu li');
    var hiddenElement = $('input[name="rating"]'); // not so good

    $(listItem).click(function(e) {
        var rating = $(this);
        var ratingNumber = rating.attr('data-value');

        if (typeof ratingNumber == 'undefined')
            return;

        button.html(rating.text());

        hiddenElement.val(rating.attr('data-value'));
    });
};

BootstrapDropDown('.dropdown');