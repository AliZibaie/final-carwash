@extends('layouts.main')
@section('title', 'services')
@section('content')
{{--    @dd($reservation)--}}
    <form action="{{route('trackings.update', $reservation)}}" method="post" class=" mx-auto w-2/3 pt-12">
        @csrf
        @method('PATCH')
        <label>
            <input type="time" value="{{$reservation->start_at}}" name="start_at">
            <button type="submit">Save</button>
        </label>
    </form>
@endsection
