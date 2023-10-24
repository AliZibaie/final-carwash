<?php

namespace App\Http\Controllers;

use App\enums\Day;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isFalse;

class ReservationController extends Controller
{
    public function reserve(StoreReservationRequest $request, Service $service)
    {
        $day = $request->validated()['day'];
        $station = $request->validated()['station'];
        $start_time = Carbon::parse($request->validated()['start_at']);
        $end_time = Carbon::parse($request->validated()['start_at'])->addMinutes($service->time)->toTimeString();
        $conflict = self::conflictExist($start_time, $end_time, $day, $station);

//        $float  = (float) $hour;
//        $result = \Illuminate\Support\Carbon::parse($hour)->addMinutes($float);
//        dd($this->getAvailableTimes($service->time,  $day, $station));
        if ($conflict[0] || $conflict[1]){
            return redirect('services')->with('fail', 'this time is already reserved!');
        }
        $info = $request->validated();
        $info['user_id'] = Auth::id();
        $info['end_at'] = $end_time;
        $reservation = Reservation::query()->create($info);
        $service->users()->attach(Auth::id());
        $service->reservations()->attach($reservation->id);
        return redirect('services')->with('success', 'you have reserved successfully');
    }

    public function fastReserve(StoreReservationRequest $request, Service $service)
    {
        $day = $request->validated()['day'];
        $station = $request->validated()['station'];
        $start_time = Carbon::parse($request->validated()['start_at']);
        $end_time = Carbon::parse($request->validated()['start_at'])->addMinutes($service->time)->toTimeString();
        $conflict = self::conflictExist($start_time, $end_time, $day, $station);
        if ($conflict[0] || $conflict[1]){
            return redirect('services')->with('fail', 'this time is already reserved!');
        }
        $info = $request->validated();
        $info['user_id'] = Auth::id();
        $info['end_at'] = $end_time;
        $reservation = Reservation::query()->create($info);
        $service->users()->attach(Auth::id());
        $service->reservations()->attach($reservation->id);
        return redirect('services')->with('success', 'you have reserved successfully');
    }
    public static function conflictExist($start_time, $end_time, $day, $place)
    {
        $check1 =  Reservation::query()->where(function ($query) use ($start_time, $end_time) {
            $query->whereBetween('start_at', [$start_time, $end_time])
                ->orWhereBetween('end_at', [$start_time, $end_time]);
//            ->where($start_time, [$query->start_at, $query->end_at]);
        })->where('day','=', $day,)->where('station', '=', $place)->first();
        $check2 =  Reservation::query()->where(function ($query) use ($start_time, $end_time) {
           $query->where('start_at', '<', $start_time, 'AND', 'end_at', '>', $start_time);
           $query->where('start_at', '<', $end_time, 'AND', 'end_at', '>', $end_time);
        })->where('day','=', $day,)->where('station', '=', $place)->first();
        return [$check1, $check2];
    }
    public function indexFilterByService(Request $request)
    {
        $service = Service::find($request->service);
        dd($service->reservations);
    }
    public function indexFilterByDay(Request $request)
    {
        $reservations = Reservation::query()->where('day', $request->day)->get();
        dd($reservations);
    }

    public function index()
    {
        $services = Service::all();
        $days = array_map(fn($day)=>$day->name, Day::cases());
        return view('reservations.index', compact('services', 'days'));
    }

    public function getAvailableTimes($serviceTime, $day, $place) : array
    {
        $allTimes = range(9*60, 21*60, $serviceTime);
        $reservations = Reservation::where('day', $day)
            ->where('station', $place)
            ->get();
        $hour = array_map(fn($time)=>$time/60, $allTimes);
        $integer  = array_map(fn($hour)=>(int) $hour,$hour);
        $float  = array_map(fn($hour)=>($hour - (int) $hour) * 60 ,$hour);
        $start  = array_map(fn($integer, $float)=> \Illuminate\Support\Carbon::parse($integer.':'.$float)->toTimeString() >= '21:00:00' ? null : \Illuminate\Support\Carbon::parse($integer.':'.$float)->toTimeString(), $integer, $float);
        $end  = array_map(fn($integer, $float)=> \Illuminate\Support\Carbon::parse($integer.':'.$float)->addMinutes($serviceTime)->toTimeString() >= '21:00:01' ? null : \Illuminate\Support\Carbon::parse($integer.':'.$float)->addMinutes($serviceTime)->toTimeString(), $integer, $float);
//        $end = array_map(fn($integer, $float)=> \Illuminate\Support\Carbon::parse($integer.':'.$float)->toTimeString(), $integer, $float);
        $start = $this->notNull($start);
        $end = $this->notNull($end);
//        dd($start, $end);
        return $this->notNull(array_map(fn($start, $end)=>$this->getWithOutConflict($start, $end, $day, $place), $start, $end));
    }

    public function notNull(array $items) : array
    {
        $newItems = [];
        foreach ($items as $item){
            if ($item){
                $newItems[] = $item;
            }
        }
        return $newItems;
    }

    public function getWithOutConflict( $start,  $end, $day, $place)
    {
        $conflict = self::conflictExist($start, $end, $day, $place);
        if($conflict[0] || $conflict[1]){
            return  null;
        }
            return  $start;
    }

}
