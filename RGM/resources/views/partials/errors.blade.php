@if(session()->has('error_notification'))
    <div class="errorBox">
        <div class="alert alert-danger fade in text-center show">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Notification: </strong> {{ session()->get('error_notification') }}
        </div>
    </div>
@endif