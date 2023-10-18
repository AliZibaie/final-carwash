@extends('layouts.auth')
@section('content')
    <form action="{{route('login')}}" method="post" class=" mx-auto w-2/3 pt-12">
        @csrf
        <div class="flex flex-col px-8 w-1/3 mx-auto space-y-4 pt-8">
            <label>
                <input type="text" placeholder="phone number" class="input input-bordered input-info w-full max-w-xs" name="phone" value="{{old('phone')}}">
            </label>
            @error("phone")
            <p class="text-2xl text-red-700">{{$message}}</p>
            @enderror
            <label>
                <input type="password" placeholder="password" class="input input-bordered input-info w-full max-w-xs" name="password" >
            </label>
            @error("password")
            <p class="text-2xl text-red-700">{{$message}}</p>
            @enderror
            <div class="flex justify-between">
                <a href="{{route('show.register')}}" class="btn btn-primary">Register</a>
                <button type="submit" class="btn btn-success">Login</button>
            </div>
        </div>
    </form>
@endsection
