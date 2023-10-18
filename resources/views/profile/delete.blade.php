@extends('layouts.main')
@section('title', 'dashboard')
@section('content')

    <div class="w-1/2 mx-auto flex justify-between pt-4">
        <a href="" class="btn btn-warning">Back </a>
        <form action="" method="post">
            @csrf
            <button type="submit" class="btn btn-error">Delete Account</button>
        </form>
    </div>

@endsection
