if (!$('#popupContent').is(':empty')) {
    $('#popupLayer').css('visibility', 'visible');
}

$("#popUpCloseBtn").click(function () {
    $('#popupLayer').css('visibility', 'hidden');
});