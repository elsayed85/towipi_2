<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $faqs = Faq::latest()->with(['translations'])->paginate(10);
        return view('site.faq' ,  get_defined_vars());
    }
}
