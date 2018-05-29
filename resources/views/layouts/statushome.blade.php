<style>
    .alert{
        margin-bottom: 0px!important;
        padding:0px 30px!important;
    }
</style>

@if (session('status'))
    <div class="alert alert-success">
        <h6>{{ session('status') }}</h6>
    </div>
@endif
