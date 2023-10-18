@extends('layouts.main')
@section('title', 'dashboard')
@section('content')
    <div class=" border border-success rounded-lg w-1/2 mx-auto text-center px-12 py-4 space-y-4 mt-4">
        <h1 class="text-2xl">profile info</h1>
        <div class="flex justify-between">
            <p class="text-xl">name : </p>
            <p class="text-xl">{{Auth::User()->full_name}}</p>
        </div>
        <div class="flex justify-between">
            <p class="text-xl">phone : </p>
            <p class="text-xl">{{Auth::User()->phone}}</p>
        </div>
        <div class="flex justify-between">
            <p class="text-xl">joined at : </p>
            <p class="text-xl">{{Auth::User()->created_at}}</p>
        </div>
    </div>
    <div class="w-1/2 mx-auto flex justify-between pt-4">
        <a href="{{route('profile.edit')}}" class="btn btn-warning">Edit </a>
        <form action="{{route('profile.destroy')}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-error">Delete Account</button>
        </form>
    </div>
    @if(session('success'))
        <p class="text-success text-2xl text-center mx-auto">{{session('success')}}</p>
    @endif
    @if(session('fail'))
        <p class="text-success text-2xl text-center mx-auto">{{session('fail')}}</p>
    @endif

@endsection
