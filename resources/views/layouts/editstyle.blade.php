@if ($cafe[0]->tabcolour != '' AND $cafe[0]->tabtextcolour != '')
    <style>
    .icon-bar a {
        color:  {{$cafe[0]->tabcolour}};
    }

    .icon-bar {
        background-color: {{$cafe[0]->tabtextcolour}};;
    }

    .icon-bar-right a{
        float:right;
    }
    </style>
@endif
