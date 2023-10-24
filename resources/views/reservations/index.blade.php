@extends('layouts.main')
@section('title', 'welcome')
@section('content')
{{--    @dd($services[0]->reservations[0]->user)--}}
    <div class="overflow-x-auto mx-auto w-2/3 mt-12 flex items-start space-x-4">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
            <tr>
                <th>reserved by</th>
                <th>service name</th>
                <th>starts at</th>
                <th>day</th>
                <th>station</th>
            </tr>
            </thead>
            <tbody>
            <!-- row 1 -->
            @forelse($services as $service)
                @forelse($service->reservations as $reservation)
{{--                    {{$reservation}}--}}
                    <tr>
                        <td>{{$reservation->user->full_name}}</td>
                        <td>{{$service->name}}</td>
                        <td>{{$reservation->start_at}}</td>
                        <td>{{$reservation->day}}</td>
                        <td>{{$reservation->station}}</td>
                    </tr>
                @empty
                @endforelse

            @empty
                <p>There is no reservation yet!</p>
            @endforelse


            </tbody>
        </table>

        <div>
            <form action="{{route('filter.day')}}" method="post">
                @csrf
                <div class="form-control">
                    <div class="input-group">
                        <select class="select select-bordered" name="day">
                            <option disabled selected>Filter by day</option>
                            @foreach($days as $day)
                                <option name="{{$day}}">{{$day}}</option>
                            @endforeach
                        </select>
                        <button class="btn" type="submit">Filter</button>
                    </div>
                </div>
            </form>
            <form action="{{route('filter.service' )}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-control">
                    <div class="input-group">
                        <select class="select select-bordered" name="service">
                            <option disabled selected>Filter by service</option>
                            @foreach($services as $service)
                                <option name="{{$service->name}}"  value="{{$service->id}}">{{$service->name}}</option>
                            @endforeach

                        </select>
                        <button type="submit" class="btn">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
