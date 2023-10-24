@extends('layouts.main')
@section('title', 'services')
@section('content')
    <div class="overflow-x-auto mt-8 mx-auto w-3/4 flex mb-12">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
            <tr>
                <th class="text-xl text-green-700">Start Time</th>
                <th class="text-xl text-green-700">End Time</th>
                <th class="text-xl text-green-700">Day</th>
                <th class="text-xl text-green-700">Station</th>
                <th class="text-xl text-green-700">Actions</th>
            </tr>
            </thead>
            <tbody>
            <!-- row 1 -->
            @foreach($reservations as $reservation)
                <tr>
                    <td class="text-lg">{{$reservation->start_at}}</td>
                    <td class="text-lg">{{$reservation->end_at}}</td>
                    <td class="text-lg">{{$reservation->day}}</td>
                    <td class="text-lg">{{$reservation->station}}</td>
                    <td>
                        <div class="flex space-x-2">
                                <form action="{{route('tracking.destroy', $reservation)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-error ">
                                        Cancel
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12L20 6.91Z"/></svg></button>
                                </form>
                                <a href="{{route('trackings.edit', $reservation)}}" class="btn btn-warning">
                                    Edit
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 12 12"><path fill="currentColor" d="M7.736 1.56a1.914 1.914 0 0 1 2.707 2.708l-.234.234l-2.707-2.707l.234-.234Zm-.941.942L1.65 7.646a.5.5 0 0 0-.136.255l-.504 2.5a.5.5 0 0 0 .588.59l2.504-.5a.5.5 0 0 0 .255-.137l5.145-5.145l-2.707-2.707Z"/></svg>
                                </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if(session('success'))
        <p class="text-success text-2xl text-center mx-auto">{{session('success')}}</p>
    @endif
    @if(session('fail'))
        <p class="text-error text-2xl text-center mx-auto">{{session('fail')}}</p>
    @endif
@endsection
