@if (session()->has('message'))
    <div style="text-align: center" class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
