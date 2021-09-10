<?php

namespace App\Http\Controllers;

use App\Models\Publicholiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchHolidays(Request $request)
    {
        $year = $request->get('year');
        $country = 'zaf';
        $holidayType = 'public_holiday';
        $action = 'getHolidaysForYear';
        $api_url = "https://kayaposoft.com/enrico/json/v2.0/?action=".$action."&year=".$year."&country=".$country."&holidayType=".$holidayType;

        $publicholidays = Http::get($api_url)->json();

        $count = count($publicholidays);

        $holidays = array();

        for($x = 0; $x < $count; $x++)
        {
            $holidays[$x] = array(
                'day'=>$publicholidays[$x]['date']['day'],
                'month'=>$publicholidays[$x]['date']['month'],
                'year'=>$publicholidays[$x]['date']['year'],
                'dayOfWeek'=>$publicholidays[$x]['date']['dayOfWeek'],
                'text'=>$publicholidays[$x]['name'][0]['text']
            );
        }

        Publicholiday::insert($holidays);

        //dump(Publicholiday);

        return view('Home',[
            'publicholidays' => $publicholidays
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
