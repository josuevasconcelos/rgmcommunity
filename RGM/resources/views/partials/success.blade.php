@if(session()->has('success_notification'))
    <div class="successBox">
        <div class="alert alert-success fade in text-center show">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Notification: </strong> {{ session()->get('success_notification') }}
        </div>
    </div>
@endif