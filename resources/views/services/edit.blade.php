@extends('layouts.main')
@section('title', 'services')
@section('content')
    <form action="{{route('services.update', $service)}}" method="post" class=" mx-auto w-2/3 pt-12">
        @csrf
        @method('PATCH')
        <div class="flex flex-col px-8 w-1/3 mx-auto space-y-4 pt-8">
            <label>
                <input type="text" placeholder="name" class="input input-bordered input-info w-full max-w-xs text-success" name="name" value="{{$service->name}}">
            </label>
            @error("name")
            <p class="text-2xl text-red-700">{{$message}}</p>
            @enderror
            <label>
                <input type="number" placeholder="price" class="input input-bordered input-info w-full max-w-xs text-success" name="price" value="{{$service->price}}">
            </label>
            @error("price")
            <p class="text-2xl text-red-700">{{$message}}</p>
            @enderror
            <label>
                <input type="number" placeholder="time" class="input input-bordered input-info w-full max-w-xs" name="time"  value="{{$service->time}}">
            </label>
            @error("time")
            <p class="text-2xl text-red-700">{{$message}}</p>
            @enderror
            <div class="flex justify-between">
                <a href="{{route('services.index')}}" class="btn btn-primary">Back</a>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection
