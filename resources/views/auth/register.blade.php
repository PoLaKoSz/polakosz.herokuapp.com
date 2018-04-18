@if (env('APP_REG_ENABLED'))
    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('registration_name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">{{ trans('login-panel.name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="registration_name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('registration_email') ? ' has-error' : '' }}">
            <label for="reg_email" class="col-md-4 control-label">{{ trans('login-panel.email') }}</label>

            <div class="col-md-6">
                <input id="reg_email" type="email" class="form-control" name="registration_email" value="{{ old('reg_email') }}" required>

                @if ($errors->has('reg_email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('reg_email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('registration_password') ? ' has-error' : '' }}">
            <label for="reg_password" class="col-md-4 control-label">{{ trans('login-panel.password') }}</label>

            <div class="col-md-6">
                <input id="reg_password" type="password" class="form-control" name="registration_password" required>

                @if ($errors->has('reg_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('reg_password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="reg_password-confirm" class="col-md-4 control-label">{{ trans('login-panel.password_conf') }}</label>

            <div class="col-md-6">
                <input id="reg_password-confirm" type="password" class="form-control" name="registration_password_confirmation" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    {{ trans('login-panel.btn_reg') }}
                </button>
            </div>
        </div>
    </form>
@else
    <p class="alert alert-info">{{ trans('login-panel.reg_disabled') }}</p>
@endif