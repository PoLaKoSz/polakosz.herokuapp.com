<li><a href="{{ LaravelLocalization::localizeURL('/') }}">{{ trans('navbar.menu_home') }} <span class="sr-only">(current)</span></a></li>
<li><a href="{{ LaravelLocalization::localizeURL('movies/new') }}">{{ trans('navbar.menu_new_movie') }}</a></li>
<li>
    <a href="{{ LaravelLocalization::localizeURL('logout') }}"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        {{ trans('navbar.menu_logout') }}
    </a>

    <form id="logout-form" action="{{ LaravelLocalization::localizeURL('logout') }}" method="POST" class="hidden">
        {{ csrf_field() }}
    </form>
</li>
