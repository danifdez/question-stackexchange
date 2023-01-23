<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Question extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return  Http::get('https://api.stackexchange.com/2.3/questions', [
            'tagged' => $request->get('tagged'),
            'site' => 'stackoverflow'
        ])->json();
    }
}
