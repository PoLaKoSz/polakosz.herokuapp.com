$('#hideShowDateFieldCheckBox').on('change', function() {
    $(this).closest('fieldset').find('.hideshow').toggle(!this.checked);
});

function BootstrapDropDown(containerName) {
    var button = $(containerName + ' button#dropdownMenu');
    var listItem = $(containerName + ' ul.dropdown-menu li');
    var hiddenElement = $('input[name="rating"]');

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

function getElementByName(elementName) {
    return $('[name="' + elementName + '"]');
}

var originalHungarianTitle;

var originalEnglishTitle;

function genericSearch( endpoint, query, callbackFunction ) {
    var container = $( '#' + endpoint );
    container.empty();

    container.append(
        '<div class="progress">' +
            '<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>' +
        '</div>');

    if ( query.length < 2 )
    {
        container.empty();
        return;
    }

    $.ajax({
        url:       '/api/movies/search/' + endpoint,
        type:      'GET',
        dataType:  'json',
        data: {
            movie_name: query,
            _token:     $('meta[name="csrf-token"]').attr('content'),
        },
        success: function( data ){
            callbackFunction({
                'isSuccess' : true,
                'column'    : endpoint,
                'response'  : data
            });
        },
        error: function( xhr ) {
            callbackFunction({
                'isSuccess' : false,
                'column'    : endpoint,
                'response'  : xhr.status
            });
        }
    });
}

function updateColumn( data ) {
    var container = $( '#'+data.column );
    container.empty();

    if ( !data.isSuccess )
    {
        container.html( 'HTTP '+data.response );
        return;
    }

    results[data.column] = data.response;

    $.each(data.response, function(index, item) {
        var movieDOM = $('<p class="searchResult" data-index="' + index +'" data-column="' + data.column + '">' +
            '<img src="' + item['image'] + '" style="width:60px;height:90px">' +
            '<span style="display: inline-table;"><a href="' + item['url'] + '" target="_blank">' + item['name'] + '</a><br>' + item['year'] + '</span></p>');

        container.append( movieDOM );
    });

    container.on("click", "p.searchResult", function(){
        var rowIndex = $(this).data('index');
        var columnName = $(this).data('column');

        var movie = results[columnName][rowIndex];

        getElementByName( columnName + '_id' ).val( movie.id );

        if (columnName == 'imdb')
        {
            getElementByName( 'title_en' ).val( movie.name );
            originalEnglishTitle = movie.name;
        }
        else
        {
            getElementByName( 'title_hu' ).val( movie.name );
            originalHungarianTitle = movie.name;
        }

        if (columnName == 'imdb')
        {
            getElementByName( 'cover_image' ).val( movie.image );
            $( '#moviePoster' ).html( $( '<img src="' + movie.image + '">' ) );
        }
    });
}

function mafabSearch( query ) {
    genericSearch( 'mafab', query, updateColumn );
}

function imdbSearch( query ) {
    genericSearch( 'imdb', query, updateColumn );
}

var genericSearchBox = getElementByName('search_query');
var mafabSearchBox   = getElementByName('mafab_search_query');
var imdbSearchBox    = getElementByName('imdb_search_query');

var results = [];

genericSearchBox.focusout(function(){
    mafabSearch( genericSearchBox.val() );
    imdbSearch( genericSearchBox.val() );
});

mafabSearchBox.focusout(function(){
    mafabSearch( mafabSearchBox.val() );
});

imdbSearchBox.focusout(function(){
    imdbSearch( imdbSearchBox.val() );
});

$('#is_tv_series').change(function(){
    if ($(this).is(':checked')) {
        $('#seasonContinainer').css('display', 'block');
    }
    else {
        $('#seasonContinainer').css('display', 'none');
    }
});

function resetMovieTitle( content ) {
    getElementByName('title_hu').val(originalHungarianTitle + content );
    getElementByName('title_en').val(originalEnglishTitle + content );
}

function addSeason( content ) {
    resetMovieTitle(' S' + pad( $('#season_number').val(), 2 ) + content );
}

function addFirstEpisode( content ) {
    addSeason(' EP' + pad( $('#ep_first_number').val(), 2 ) + content );
}

function addLastEpisode() {
    addFirstEpisode('-' + pad( $('#ep_last_number').val(), 2 ) );
}

$('#season_number').change(function(){
    addSeason('');
});

$('#ep_first_number').change(function(){
    addFirstEpisode('');
});

$('#ep_last_number').change(function(){
    addLastEpisode();
});

function pad (str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
}
