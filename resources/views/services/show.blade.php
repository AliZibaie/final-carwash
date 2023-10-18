@extends('layouts.main')
@section('title', 'services')
@section('content')
        <div class="card lg:card-side bg-base-100 shadow-xl mt-4 w-2/3 mx-auto">
           <img src="{{ URL::asset("img/wash.jpg")}}" alt="wash" height="400" width="400">
            <div class="card-body">
                <h2 class="card-title">Some title</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda beatae consectetur deleniti dignissimos dolorem ea, earum est et id ipsam iusto labore natus, provident quasi quisquam tempore veritatis vitae, voluptatibus?</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-warning">Manual Reserve</button>
                    <button class="btn btn-success">Fast Reserve</button>
                    <a class="btn btn-info" href="{{route('services.index')}}">Back</a>
                </div>
            </div>
        </div>
@endsection
