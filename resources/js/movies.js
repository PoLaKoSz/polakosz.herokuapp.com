$('#isWatchedToday').change(function() {
    if ($(this).is(':checked')) {
        $('#datepicker').addClass('d-none');
    }
    else {
        $('#datepicker').removeClass('d-none');
    }
});

$(document).ready(function () {
    $(".datepicker").datepicker({
        todayHighlight: true,
        autoclose: true,
    });

    function isInEditMode() {
        return document.getElementById("huTitle").value !== "";
    }

    function isTvShow() {
        return document.getElementById("huTitle").value.match(/\w+ S\d\d /) !== null;
    }

    function populateTvShowInputs() {
        const hungarianTitle = document.querySelector("#mafabSearch").value;
        const englishTitle = document.querySelector("#imdbSearch").value;
        const huSeason = hungarianTitle.match(/S\d\d/)[0].substr(1);
        const enSeason = englishTitle.match(/S\d\d/)[0].substr(1);
        if (huSeason !== enSeason) {
            throw "Season value mismatch!";
        }

        originalHungarianTitle = hungarianTitle.substr(0, hungarianTitle.match(/ S\d\d/).index);
        originalEnglishTitle = englishTitle.substr(0, englishTitle.match(/ S\d\d/).index);

        $('#season_number').val(Number(huSeason));

        const firstEpisode = hungarianTitle.match(/ EP\d\d/)[0].substr(3)
        $('#ep_first_number').val(Number(firstEpisode));
        addFirstEpisode("");

        const lastEpisode = document.querySelector("#mafabSearch").value.match(/ EP\d\d-\d\d/);
        if (lastEpisode !== null)
        {
            $('#ep_last_number').val(Number(lastEpisode[0].substr(6)));
            addLastEpisode();
        }
    }

    if (isInEditMode() && isTvShow())
    {
        $('#is_tv_series').prop('checked', true);
        $('#is_tv_series').trigger("change");
        populateTvShowInputs();
    }
});

function bootstrapDropDown(containerName) {
    const button = $(containerName + ' button');
    const listItem = $(containerName + ' .dropdown-menu .dropdown-item');
    const hiddenElement = $('input[name="rating"]');

    $(listItem).click(function(e) {
        var rating = $(this);
        var ratingNumber = rating.attr('data-value');

        if (typeof ratingNumber == 'undefined')
            return;

        button.html(rating.text());

        hiddenElement.val(rating.attr('data-value'));
    });

    if (hiddenElement.val() === "") {
        return;
    }

    listItem.each((i, option) => {
        if ($(option).attr("data-value") === hiddenElement.val()) {
            button.html($(option).text());
        }
    });
};

bootstrapDropDown('.dropdown');

function getElementByName(elementName) {
    return $('[name="' + elementName + '"]');
}

var originalHungarianTitle;

var originalEnglishTitle;

function genericSearch( endpoint, query, callbackFunction ) {
    var container = $( '#' + endpoint );
    container.empty();

    container.append(
        '<div class="progress mb-2">' +
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

    $.each(data.response, function(index, movie) {
        const movieDOM = $(
            `<div data-index="${index}" data-column="${data.column}" class="result row mb-2">
                <div class="col-4 pr-0">
                    <img src="${movie.image}" class="img-fluid">
                </div>
                <div class="col-8 pl-2">
                    <div>
                        <a href="${movie.url}" target="_blank">${movie.name}</a>
                    </div>
                    (<small class="font-italic text-muted">${movie.year}</small>)
                </div>
            </div>`);

        container.append( movieDOM );
    });

    container.on("click", ".result", function(){
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
            $( '#moviePoster' ).html( $( '<img src="' + movie.image + '" class="img-fluid">' ) );
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
        $('#seasonContinainer').removeClass('d-none');
    }
    else {
        $('#seasonContinainer').addClass('d-none');
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
