@if(Session::has('flash_message1'))

    <div class="alert alert-danger">

        {{ Session::get('flash_message1') }}

    </div>

@endif