<?php

use Illuminate\Support\Facades\DB;

function localUrl($url = "")
{
    return \LaravelLocalization::localizeUrl($url);
}


function qlog()
{
    dd(DB::getQueryLog());
}


