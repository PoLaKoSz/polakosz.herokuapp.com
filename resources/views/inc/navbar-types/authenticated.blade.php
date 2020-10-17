<li class="nav-item"><a href="{{ LaravelLocalization::localizeURL('/') }}" class="nav-link active">{{ trans('navbar.menu_home') }} <span class="sr-only">(current)</span></a></li>
<li class="nav-item"><a href="{{ LaravelLocalization::localizeURL('movies/new') }}" class="nav-link">{{ trans('navbar.menu_new_movie') }}</a></li>
<li class="nav-item"><a href="{{ LaravelLocalization::localizeURL('movies/') }}" class="nav-link">{{ trans('movies.title') }}</a></li>
<li class="nav-item">
    <a href="{{ LaravelLocalization::localizeURL('logout') }}"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
       class="nav-link">
        {{ trans('navbar.menu_logout') }}
    </a>

    <form id="logout-form" action="{{ LaravelLocalization::localizeURL('logout') }}" method="POST" class="hidden">
        {{ csrf_field() }}
    </form>
</li>
