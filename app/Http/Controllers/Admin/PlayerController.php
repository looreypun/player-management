<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{
    /**
     * player list
     * @return View
     */
    public function index()
    {
        $positions = Position::all();
        return view('admin.player.index', compact('positions'));
    }

    /**
     * player search
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $filter = $request->all();

        $users = new User();
        $users = $users->paginateWithFilter($filter, 20);
        return response()->json($users);
    }

    /**
     * add player
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $player = new User();

        $player->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'phone' => $request->phone,
            'position_id' => $request->position_id,
            'img_url' => $request->img_url
        ]);

        $player->save();

        return response()->json(['message' => 'Player Added Successfully']);
    }

    /**
     * update player info
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $player = User::find($id);
        $player->fill($request->all());
        $player->save();

        return response()->json(['message' => 'Player info updated']);
    }

    /**
     * delete player info
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(['message' => 'Player info deleted']);
    }
}
