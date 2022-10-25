<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demand;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {//     ->orWhereNull('userId')
        $demands = Demand::with('customer')->orderBy('updated_at','desc')->get()->map(function($item){
            $item['count'] = DemandMessage::where('demandId',$item->id)
            ->where('userId', '!=',Auth::id())
            ->where('isRead', 1)
            ->count();
            return $item;
        });
        return view('home', [
            'demands'=>$demands
        ]);
    
        //return view('home');
    }
}
