<?php

namespace App\Http\Controllers;

use Datetime;
use Illuminate\Http\Request;
use App\Http\Requests\GetQuestionRequest;
use Illuminate\Support\Facades\Http;

class Question extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(GetQuestionRequest $request)
    {
        $params = $this->makeParams($request);

        return  Http::get('https://api.stackexchange.com/2.3/questions', $params)->json();
    }

    private function makeParams(Request $request)
    {
        $params = [
            'tagged' => $request->get('tagged'),
            'site' => 'stackoverflow'
        ];

        if ($request->get('todate')) {
            $params['todate'] = (new DateTime($request->get('todate')))->format('U');
        }
        if ($request->get('fromdate')) {
            $params['fromdate'] = (new DateTime($request->get('fromdate')))->format('U');
        }

        return $params;
    }
}
