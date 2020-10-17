@if (env('APP_REG_ENABLED'))
    <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="regUsername">{{ trans('login-panel.name') }}</label>
            <input type="text" name="registration_name" id="regUsername" required autocomplete="username" class="form-control">
        </div>

        <div class="form-group">
            <label for="regEmail">{{ trans('login-panel.email') }}</label>
            <input type="email" name="registration_email" id="regEmail" required autocomplete="email" class="form-control" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
            <label for="regPassword">{{ trans('login-panel.password') }}</label>
            <input type="password" name="registration_password" id="regPassword" required autocomplete="off" class="form-control">
        </div>

        <div class="form-group">
            <label for="regPasswordConfirm">{{ trans('login-panel.password_conf') }}</label>
            <input type="password" name="registration_password_confirmation" id="regPasswordConfirm" required autocomplete="new-password" class="form-control">
        </div>

        <button type="submit" class="btn btn-orange">{{ trans('login-panel.btn_reg') }}</button>
    </form>
@else
    <p class="alert alert-info">{{ trans('login-panel.reg_disabled') }}</p>
@endif
