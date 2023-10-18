<div class="navbar  bg-base-300 ">
    <div class="navbar-start">

        <a class="btn btn-ghost normal-case text-xl">Bolbol Wash</a>
    </div>
    <div class="navbar-center">
        @auth()
            <ul class="flex space-x-4">
                <li><a href="{{route('services.index')}}">Services</a></li>
                @can("users_index")
                    <li><a href="">users</a></li>
                @endcan
                @can("requests_index")
                    <li><a href="">Requests</a></li>
                @endcan
            </ul>
        @endauth
    </div>
    <div class="navbar-end space-x-4">
            @auth()
            <details class="dropdown dropdown-end">
                <summary class=" btn btn-success">{{\Illuminate\Support\Facades\Auth::user()->full_name}}</summary>
                <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                    <li><a class="" href="{{route('dashboard')}}">dashboard</a></li>
                    <li><a class="" href="{{route('dashboard')}}">Tracking</a></li>
                    <li>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit">logout</button>
                        </form>
                    </li>
                </ul>
            </details>
            @endauth
                @guest()
                    <a class="btn btn-info" href="{{route('show.login')}}">Login</a>
                    <a class="btn btn-success " href="{{route('show.register')}}">Register</a>
                @endguest

    </div>
</div>
