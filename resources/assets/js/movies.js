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

function genericSearch( endpoint, query, callbackFunction ) {
    if ( query.length < 2 )
        return;

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
        }
        else
        {
            getElementByName( 'title_hu' ).val( movie.name );
        }

        getElementByName( 'cover_image' ).val( movie.image );

        $( '#moviePoster' ).html( $( '<img src="' + movie.image + '">' ) );
    });
}

function mafabSearch( query ) {
    genericSearch( 'mafab', query, updateColumn );
}

function portSearch( query ) {
    genericSearch( 'port', query, updateColumn );
}

function imdbSearch( query ) {
    genericSearch( 'imdb', query, updateColumn );
}

var genericSearchBox = getElementByName('search_query');
var portSearchBox    = getElementByName('port_search_query');
var mafabSearchBox   = getElementByName('mafab_search_query');
var imdbSearchBox    = getElementByName('imdb_search_query');

var results = [];

genericSearchBox.focusout(function(){
    mafabSearch( genericSearchBox.val() );
    portSearch( genericSearchBox.val() );
});

portSearchBox.focusout(function(){
    portSearch( portSearchBox.val() );
});

mafabSearchBox.focusout(function(){
    mafabSearch( mafabSearchBox.val() );
});

imdbSearchBox.focusout(function(){
    imdbSearch( imdbSearchBox.val() );
});
