<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PositionController extends Controller
{
    /**
     * position list
     * @return View
     */
    public function index(): View
    {
        return view('admin.position.index');
    }

    /**
     * position list
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $positions = Position::all();
        return response()->json($positions);
    }

    /**
     * add position
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $player = new Position();
        $player->fill($request->all());
        $player->save();

        return response()->json(['message' => 'Position Added Successfully']);
    }

    /**
     * update position info
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $player = Position::find($id);
        $player->fill($request->all());
        $player->save();

        return response()->json(['message' => 'Position info updated']);
    }

    /**
     * delete position info
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $user = Position::find($id);
        $user->delete();

        return response()->json(['message' => 'Position info deleted']);
    }
}
