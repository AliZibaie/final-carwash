<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    public function index()
    {
        $reservations = User::find(Auth::id())->reservations;
//        $services = Service::find(3)->users;
//        $services = Service::find(3)->reservations;
//        dd($services);
//        dd($reservations);
        return view('trackings.index', compact('reservations'));
    }

    public function edit(int $id)
    {
        $reservation = Reservation::find($id);
        return view('trackings.edit', compact('reservation'));
    }
    public function update(Request $request, int $id)
    {
        $request->all();
        $reservation = Reservation::find($id);
        dd($reservation,$request->all());
    }
    public function destroy(int $id)
    {
        $reservation = Reservation::find($id);
        $user_id = $reservation->user->id;
         $service_id = DB::table('reservation_service')->where('reservation_id', $id)->select('service_id')->get()[0]->service_id;
        DB::table('reservation_service')->where('reservation_id', $id)->delete();
//         dd($service_id);
         DB::table('service_user')->where(['user_id'=>$id, 'service_id'=>$service_id])->delete();
        Reservation::query()->where('id', $id)->delete();
        return redirect('trackings')->with('success', 'service has been deleted successfully!');
    }
}
