<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Ticketitem;
use App\Ticketitemtracking;
use Carbon\Carbon;

class AdminController extends Controller
{
  public function getDashboard()
  {
    $getdashboard['cucounter'] = Ticket::whereDate('modified_time','=',date(Carbon::today()))->where('total_price','>','0')->sum('number_of_guests');
    $getdashboard['totalprice'] = Ticket::whereDate('modified_time','=',date(Carbon::today()))->sum('total_price');
    $getdashboard['menuterjual'] = Ticketitem::whereDate('modified_time','=',date(Carbon::today()))->sum('authorized');
    $getdashboard['servdurcount'] = Ticketitemtracking::whereDate('updated_at','=',date(Carbon::today()))->where('received_duration','>','15')->count();
    return view('dashboard.menu')->with('getdashboard', $getdashboard);
  }

}
