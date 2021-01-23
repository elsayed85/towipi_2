<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\General\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Page $page)
    {
        return view('site.pages.base', ['page' => $page]);
    }
}
