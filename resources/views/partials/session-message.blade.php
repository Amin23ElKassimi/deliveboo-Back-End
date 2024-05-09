
@if (session('message'))
<div class="col-12">
    <div class="alert alert-{{ session('alert-class') }}">
        {{ session('message') }}
    </div>
</div>
@endif