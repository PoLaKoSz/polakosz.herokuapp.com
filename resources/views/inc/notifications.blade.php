<div class="container">
    <div id="modalNotification" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    {{ trans('notifications.title') }}
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @if (count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                <p>{{$error}}</p>
                            </div>
                        @endforeach
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{session('success')}}</p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <p>{{session('error')}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
