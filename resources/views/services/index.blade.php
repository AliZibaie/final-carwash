@extends('layouts.main')
@section('title', 'services')
@section('content')
    <div class="overflow-x-auto mt-8 mx-auto w-3/4 flex">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
            <tr>
                <th class="text-xl text-green-700">Name</th>
                <th class="text-xl text-green-700">price</th>
                <th class="text-xl text-green-700">Time required</th>
                <th class="text-xl text-green-700">Actions</th>
            </tr>
            </thead>
            <tbody>
            <!-- row 1 -->
            @foreach($services as $service)
                <tr>
                    <td>{{$service->name}}</td>
                    <td>{{$service->price}}</td>
                    <td>{{$service->time}}</td>
                    <td>
                        <div class="flex space-x-2">
                            @can('services_delete')
                                <form action="" method="">
                                    <button type="submit" class="btn btn-error">
                                        Delete
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20 6.91L17.09 4L12 9.09L6.91 4L4 6.91L9.09 12L4 17.09L6.91 20L12 14.91L17.09 20L20 17.09L14.91 12L20 6.91Z"/></svg></button>
                                </form>
                            @endcan
                                @can('services_edit')
                                    <a href="{{route('services.edit', $service)}}" class="btn btn-warning">
                                        Edit
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 12 12"><path fill="currentColor" d="M7.736 1.56a1.914 1.914 0 0 1 2.707 2.708l-.234.234l-2.707-2.707l.234-.234Zm-.941.942L1.65 7.646a.5.5 0 0 0-.136.255l-.504 2.5a.5.5 0 0 0 .588.59l2.504-.5a.5.5 0 0 0 .255-.137l5.145-5.145l-2.707-2.707Z"/></svg>
                                    </a>
                                @endcan
                            <a href="{{route('services.show', $service)}}" class="btn btn-info">Show
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5Z"/></svg></a>
                            <a href="{{route('services.reserve', $service)}}" class="btn btn-accent">
                                reserve
                                </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @can('services_add')
            <a  class="btn btn-success" href="{{route('services.create')}}">Add <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M20 14h-6v6h-4v-6H4v-4h6V4h4v6h6v4Z"/></svg></a>
        @endcan

    </div>
@endsection
