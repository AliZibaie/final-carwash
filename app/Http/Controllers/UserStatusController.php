<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Ramsey\Collection\Collection;

class UserStatusController extends Controller
{
    public function index()
    {
        $users = User::all();
//        dd($user);
        $users = $this->calSum($users);
        $this->activity($users);
//        array_map(fn($user)=> $this->assignSum($user), (array)$users);
//        dd($users[0]->reservations->last()->created_at->toTimeString());
        return view('users.index', compact('users'));
    }

    public function calSum(Collection $users): array|Collection
    {
        foreach ($users as &$user) {
            $sum = 0;
            foreach ($user->services as $service) {
                $sum += $service->price;
            }
            $user['sum'] = $sum;
        }
        return $users;
    }

    public function activity(Collection $users): array|Collection
    {
        foreach ($users as &$user) {
            $activity = '';
            $color = [5 => 'green', 3 => 'green',];
            if ($user->reservations->count() > 5) {
                $activity = 'text-green-700';
            } elseif ($user->reservations->count() >= 2 && $user->reservations->count() <= 5) {
                $activity = 'text-yellow-700';
            } else {
                $activity = 'text-red-700';
            }
            $user['activity'] = $activity;
        }
        return $users;
    }

    public function show(Request $request, int $id)
    {
//        $reservations = User::find($id)->reservations[0]->services;
//        $serviceReservations = User::find($id)->services[]->reservations;
//        dd($serviceReservations);
        return view('users.show', compact('user'));
    }
}
