<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PermissionController extends Controller
{
    /**
     * permission list
     * @return View
     */
    public function index(): View
    {
        return view('admin.permission.index');
    }

    /**
     * permission list
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $permissions = Permission::all();
        return response()->json($permissions);
    }

    /**
     * add permission
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $permission = new Permission();
        $permission->fill([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);
        $permission->save();

        return response()->json(['message' => 'Permission Added Successfully']);
    }

    /**
     * update permission info
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $permission = Permission::find($id);
        $permission->fill($request->all());
        $permission->save();

        return response()->json(['message' => 'Permission info updated']);
    }

    /**
     * delete permission info
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $user = Permission::find($id);
        $user->delete();

        return response()->json(['message' => 'Permission info deleted']);
    }
}
