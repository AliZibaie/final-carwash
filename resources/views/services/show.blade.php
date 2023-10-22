@extends('layouts.main')
@section('title', 'services')
@section('content')
        <div class="card lg:card-side bg-base-100 shadow-xl mt-4 w-2/3 mx-auto">
           <img src="{{ URL::asset("img/wash.jpg")}}" alt="wash" height="400" width="400">
            <div class="card-body">
                <h2 class="card-title">{{$service->name}}</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda beatae consectetur deleniti dignissimos dolorem</p>
                @error('start_at')
                <p class="text-2xl text-error">{{$message}}</p>
                @enderror
                @error('day')
                <p class="text-2xl text-error">{{$message}}</p>
                @enderror
                @error('station')
                <p class="text-2xl text-error">{{$message}}</p>
                @enderror
                <div class="card-actions justify-end">


                    <!-- You can open the modal using ID.showModal() method -->
                    <button class="btn btn-warning" onclick="my_modal_3.showModal()">Manual Reserve</button>
                    <dialog id="my_modal_3" class="modal">
                        <div class="modal-box">
                            <form method="dialog">
                                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                            </form>
                            <h3 class="font-bold text-lg">Enter the time and day you want</h3>
                            <form action="{{route('services.reserve', $service)}}" method="post" class="flex flex-col  space-y-4">
                                @csrf

                                <label>
                                    <select class="select select-warning w-full max-w-xs" name="start_at">
                                        <option disabled selected>Pick a Time</option>
                                        @foreach($times as $time)
                                            <option name="{{$time}}">{{$time}}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label>
                                    <select class="select select-warning w-full max-w-xs" name="day">
                                        <option disabled selected>Pick a day</option>
                                        @foreach($days as $day)
                                            <option name="{{$day}}">{{$day}}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label>
                                    <select class="select select-warning w-full max-w-xs" name="station">
                                        <option disabled selected>Pick a Station</option>
                                        @foreach($stations as $station)
                                            <option name="{{$station}}">{{$station}}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <button type="submit" class="btn btn-accent">Reserve</button>
                            </form>
                        </div>
                    </dialog>

                    <form action="{{route('services.fast.reserve', $service)}}" method="post">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="start_at" value="{{$fastReserve}}">
                        <input type="hidden" name="day" value="{{$days[rand(0, 4)]}}">
                        <input type="hidden" name="station" value="{{$stations[rand(0, 1)]}}">
                        <button class="btn btn-success">Fast Reserve</button>
                    </form>
                    <a class="btn btn-info" href="{{route('services.index')}}">Back</a>
                </div>
            </div>
        </div>
@endsection
