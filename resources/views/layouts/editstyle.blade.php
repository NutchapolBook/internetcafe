@if ($cafe[0]->tabcolour != '' AND $cafe[0]->tabtextcolour != '')
    <style>
    .icon-bar a {
        color:  {{$cafe[0]->tabtextcolour}};
    }

    .icon-bar {
        background-color: {{$cafe[0]->tabcolour}};
    }

    .icon-bar-right a{
        float:right;
    }

    .icon-bar a:hover {
        color: {{$cafe[0]->tabcolour}};
    }

    .btn-primary{
        border: 1px solid {{$cafe[0]->tabcolour}}!important;
        background-color: {{$cafe[0]->tabcolour}}!important;
    }

    .btn-primary:hover ,.btn-primary:active, .btn-primary:visited{
        background-color: {{$cafe[0]->tabtextcolour}}!important;
        color: {{$cafe[0]->tabcolour}}!important;
    }
    </style>
@endif
