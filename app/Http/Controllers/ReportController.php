<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    //
    public function index() {
        $dateQuery = Carbon::createFromFormat('Y-m-d H:i:s', now()->addMonths(-1))->toDateTimeString(); //FORMAT = 1975-05-21 22:00:00
        $dateQuery2 = Carbon::createFromFormat('Y-m-d H:i:s', now())->toDateTimeString();
        return view('reports', ['dateQuery' => $dateQuery, 'dateQuery2' => $dateQuery2]);
    }

    public function applyDate(Request $request){
        $validate = $request->validate([
            'dateQuery' => 'required',
            'dateQuery2' => 'required'
        ]);

        if ($validate) {
            $dateQuery = $request->dateQuery;
            $dateQuery2 = $request->dateQuery2;
            $dateQuery = Carbon::createFromFormat('Y-m-d H:i:s', $dateQuery)->toDateTimeString(); // 1975-05-21 22:00:00
            $dateQuery2 = Carbon::createFromFormat('Y-m-d H:i:s', $dateQuery2)->toDateTimeString(); // 1975-05-21 22:00:00
            return view('reports', ['dateQuery' => $dateQuery, 'dateQuery2' => $dateQuery2]);
        }

    }
}
