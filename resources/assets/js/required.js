function showNotFoundImage( image ) {
    image.onError = "";
    image.src = "{{asset('images/imagenotfound.svg')}}";

    return true;
}
