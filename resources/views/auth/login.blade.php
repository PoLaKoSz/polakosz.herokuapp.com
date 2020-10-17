<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="inputEmail">{{ trans('login-panel.email') }}</label>
        <input type="email" name="email" id="inputEmail" required autocomplete="email" class="form-control" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="inputPassword">{{ trans('login-panel.password') }}</label>
        <input type="password" name="password" id="inputPassword" required autocomplete="current-password" class="form-control">
    </div>

    <div class="form-check mb-2">
        <input type="checkbox" name="remember" id="rememberMe" class="form-check-input">
        <label class="form-check-label" for="rememberMe">{{ trans('login-panel.remember_me') }}</label>
    </div>

    <button type="submit" class="btn btn-orange">{{ trans('login-panel.btn_login') }}</button>
</form>
