@if ( $message = Session::get('success') )
<div class="alert alert-solid-success">
    {{$message}}
</div>

@endif
@if ( $message = Session::get('error') )
<div class="alert alert-solid-danger">
    {{$message}}
</div>

@endif
