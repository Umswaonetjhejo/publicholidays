<?php

namespace App\Http\Controllers;

use App\Models\Publicholiday;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Http;


class HomeController extends Controller
{
    public function index()
    {
        return view('Home');
    }

    public function fetchHolidays(Request $request)
    {
        $year = $request->get('year');
        $country = 'zaf';
        $holidayType = 'public_holiday';
        $action = 'getHolidaysForYear';
        $api_url = "https://kayaposoft.com/enrico/json/v2.0/?action=" . $action . "&year=" . $year . "&country=" . $country . "&holidayType=" . $holidayType;

        $publicholidays = Http::get($api_url)->json();

        $count = count($publicholidays);

        $holidays = array();

        for ($x = 0; $x < $count; $x++) {
            $holidays[$x] = array(
                'day' => $publicholidays[$x]['date']['day'],
                'month' => $publicholidays[$x]['date']['month'],
                'year' => $publicholidays[$x]['date']['year'],
                'dayOfWeek' => $publicholidays[$x]['date']['dayOfWeek'],
                'text' => $publicholidays[$x]['name'][0]['text']
            );
        }

        Publicholiday::insert($holidays);

        //dump(Publicholiday);

        return view('Home', [
            'publicholidays' => $publicholidays
        ]);
    }

    public function downloadpdf()
    {

        $data = Publicholiday::all();

        //dd($data);
        view()->share('publiceholiday',$data);


        $pdf = PDF::loadView('home', $data)->setOptions(['defaultFont' => 'century gothic']);

        return $pdf->download('publicholidays.pdf');
    }

}
