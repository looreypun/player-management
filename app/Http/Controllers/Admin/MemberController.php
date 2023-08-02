<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * member list
     * @return View
     */
    public function index(): View
    {
        $positions = Position::all();
        $permissions = Permission::all();
        return view('admin.member.index', compact('positions', 'permissions'));
    }

    /**
     * member search
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $filter = $request->all();
        $users = new User();
        $users = $users->paginateWithFilter($filter, 10);
        return response()->json($users);
    }

    /**
     * add member
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $member = new User();
        $member->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'phone' => $request->phone,
            'position_id' => $request->position_id,
            'img_url' => $request->img_url
        ]);
        $member->save();
        $member->givePermissionTo($request->permission_id);

        return response()->json(['message' => 'Member Added Successfully']);
    }

    /**
     * update member info
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $member = User::find($id);
        $member->fill($request->all());
        $member->save();

        $member->permissions()->detach();
        $member->givePermissionTo($request->permission_id);

        return response()->json(['message' => 'Member info updated']);
    }

    /**
     * delete member info
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $member = User::find($id);
        $member->permissions()->detach();
        $member->delete();

        return response()->json(['message' => 'Member info deleted']);
    }
}
