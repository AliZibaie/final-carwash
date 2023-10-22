<?php

namespace App\Http\Controllers;

use App\enums\Day;
use App\enums\Station;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Exception;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        try {
            Service::create($request->validated());
            return redirect('services')->with('success', 'service created successfully!');
        }
        catch (Exception $e){
            return redirect('services')->with('fail', 'failed to  create.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $days = array_map(fn($day)=>$day->name, Day::cases());
        $stations = array_map(fn($station)=>$station->name, Station::cases());

        $times = Reservation::all()->toArray();
        $times = array_map(fn($time)=>['start'=>$time['start_at'], 'end'=>$time['end_at']], $times);
        $allTimes = range(9*60, 21*60, $service->time);
        $hour = array_map(fn($time)=>$time/60, $allTimes);
        $integer  = array_map(fn($hour)=>(int) $hour,$hour);
        $float  = array_map(fn($hour)=>($hour - (int) $hour) * 60 ,$hour);
        $start  = array_map(fn($integer, $float)=> \Illuminate\Support\Carbon::parse($integer.':'.$float)->toTimeString() >= '21:00:00' ? null : \Illuminate\Support\Carbon::parse($integer.':'.$float)->toTimeString(), $integer, $float);
        $start  = $this->notNull($start);
        $rangeTime = array_map(fn($start)=>['start'=>$start, 'end'=> Carbon::parse($start)->addMinutes($service->time)->toTimeString()], $start);
        $availableTimes = $this->timesWithOutConflict($rangeTime, $times);
        $fastReserve = $availableTimes[array_key_first($availableTimes)]['start'];

        $times = array_map(fn($time)=>$time['start'], $availableTimes);
        return view('services.show', compact('service', 'days', 'stations', 'times', 'fastReserve'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {

        try {
            Service::query()->where('id',$service->id )->update($request->validated());
            return redirect('services')->with('success', 'service updated successfully!');
        }
        catch (Exception $e){
            return redirect('services')->with('fail', 'failed to  update.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
//        dd($service);
        try {
            Service::query()->where('id', $service->id)->delete();
            return redirect('services')->with('success', 'service deleted successfully!');
        }
        catch (Exception $e){
            return redirect('services')->with('fail', 'failed to  delete.');
        }
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

    public function timesWithOutConflict(array $times, array $reservedTimes) : array
    {
        foreach ($times as $key=> $time) {
            foreach ($reservedTimes as $reservedTime) {
                $result = array_diff($time ,   $reservedTime);
                if (!$result){
                    unset($times[$key]);
                }
            }
        }
        sort($times);
        return $times;
    }
}
