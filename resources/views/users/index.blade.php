{{--@dd($users[0]->services)--}}
@extends('layouts.main')
@section('title', 'services')
@section('content')
    <div class="overflow-x-auto mt-8 mx-auto w-3/4 flex mb-12">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
            <tr>
                <th class="text-xl text-green-700">Name</th>
                <th class="text-xl text-green-700">Phone number</th>
                <th class="text-xl text-green-700">Number Of reservation</th>
                <th class="text-xl text-green-700">Invoice</th>
                <th class="text-xl text-green-700">Last Time Used Service</th>
            </tr>
            </thead>
            <tbody>
            <!-- row 1 -->
            @foreach($users as $user)
                <tr>
                    <td class="text-lg"><a class="link link-success" href="{{route('users.show', $user)}}">{{$user->full_name}}</a></td>
                    <td class="text-lg ">{{$user->phone}}</td>
                    <td class="text-lg {!!$user->activity!!}">{{$user->reservations->count()}}</td>
                    <td class="text-lg">{{$user->sum}}</td>
                    <td class="text-lg">{{$user->reservations->last()->created_at ?? 'not reserved yet!'}}</td>
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
    <input type="hidden" name="" class="text-yellow-700">
@endsection
