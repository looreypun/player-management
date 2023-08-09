<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Permission;
use App\Models\Position;
class ProfileController extends Controller
{
    
    public function index($id)
    {
        $user= User::find($id);
        $positions = Position::find($id);
        $relatedPlayers = User::inRandomOrder()->take(12)->get();
        return view('admin.profile.index',compact('user','relatedPlayers','positions'));
    }

}
