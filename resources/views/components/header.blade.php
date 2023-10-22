<div class="navbar  bg-base-300 ">
    <div class="navbar-start">

        <a class="btn btn-ghost normal-case text-xl">Bolbol Wash</a>
    </div>
    <div class="navbar-center">
        @auth()
            <ul class="flex space-x-4">
                <li><a href="{{route('services.index')}}">Services</a></li>
                @can("users_index")
                    <li><a href="{{route('users.index')}}">Users</a></li>
                @endcan
                @can("requests_index")
                    <li><a href="{{route('reservations.index')}}">Reservations</a></li>
                @endcan
            </ul>
        @endauth
    </div>
    <div class="navbar-end space-x-4">
            @auth()
            <details class="dropdown dropdown-end">
                <summary class=" btn btn-success">{{Auth::user()->full_name}}</summary>
                <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
                    <li><a class="" href="{{route('dashboard')}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M13 9V3h8v6h-8ZM3 13V3h8v10H3Zm10 8V11h8v10h-8ZM3 21v-6h8v6H3Z"/></svg>dashboard</a></li>
                    <li><a class="" href="{{route('trackings.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 2048 2048"><path fill="currentColor" d="M256 0h1536v2048H256V0zm1408 1920V128H384v1792h1280zM1024 512v128H512V512h512zm0 512v128H512v-128h512zm0 512v128H512v-128h512zm493-1107l-237 237l-173-173l90-90l83 83l147-147l90 90zm0 512l-237 237l-173-173l90-90l83 83l147-147l90 90zm0 512l-237 237l-173-173l90-90l83 83l147-147l90 90z"/></svg>
                            Tracking</a></li>
                    <li>
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button type="submit" class="flex items-center justify-between w-16">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24"><g fill="currentColor"><path fill-rule="evenodd" d="M16.125 12a.75.75 0 0 0-.75-.75H4.402l1.961-1.68a.75.75 0 1 0-.976-1.14l-3.5 3a.75.75 0 0 0 0 1.14l3.5 3a.75.75 0 1 0 .976-1.14l-1.96-1.68h10.972a.75.75 0 0 0 .75-.75Z" clip-rule="evenodd"/><path d="M9.375 8c0 .702 0 1.053.169 1.306a1 1 0 0 0 .275.275c.253.169.604.169 1.306.169h4.25a2.25 2.25 0 0 1 0 4.5h-4.25c-.702 0-1.053 0-1.306.168a1 1 0 0 0-.275.276c-.169.253-.169.604-.169 1.306c0 2.828 0 4.243.879 5.121c.878.879 2.292.879 5.12.879h1c2.83 0 4.243 0 5.122-.879c.879-.878.879-2.293.879-5.121V8c0-2.828 0-4.243-.879-5.121C20.617 2 19.203 2 16.375 2h-1c-2.829 0-4.243 0-5.121.879c-.879.878-.879 2.293-.879 5.121Z"/></g></svg>
                                logout
                            </button>
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
