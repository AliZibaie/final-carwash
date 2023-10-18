@extends('layouts.auth')
@section('content')
    <form action="{{route('profile.update')}}" method="post" class=" mx-auto w-2/3 pt-12">
        @csrf
        @method('PATCH')
        <div class="flex flex-col px-8 w-1/3 mx-auto space-y-4 pt-8">
            <label>
                <input type="text" placeholder="full name" class="input input-bordered input-info w-full max-w-xs text-success" name="full_name" value="{{Auth::user()->full_name}}">
            </label>
            @error("full_name")
            {{$message}}
            @enderror
            <label>
                <input type="text" placeholder="phone number" class="input input-bordered input-info w-full max-w-xs text-success" name="phone" value="{{Auth::user()->phone}}">
            </label>
            @error("phone")
            <p class="text-2xl text-red-700">{{$message}}</p>
            @enderror
            <label>
                <input type="password" placeholder="type new password" class="input input-bordered input-info w-full max-w-xs" name="password" >
            </label>
            @error("password")
            <p class="text-2xl text-red-700">{{$message}}</p>
            @enderror
            <label>
                <input type="password" placeholder="confirm new password " class="input input-bordered input-info w-full max-w-xs" name="password_confirmation">
            </label>
            @error("password_confirmation")
            <p class="text-2xl text-red-700">{{$message}}</p>
            @enderror
            <div class="flex justify-between">
                <a href="{{route('dashboard')}}" class="btn btn-primary">Back</a>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
@endsection
