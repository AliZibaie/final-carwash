<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Models\User;
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
        return view('services.show', compact('service'));
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

    public function reserve()
    {
        //
    }

    public function fastReserve()
    {
        //
    }
}
