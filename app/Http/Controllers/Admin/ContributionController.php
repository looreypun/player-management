<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Contribution;

class ContributionController extends Controller
{
    /**
     * contribution list
     * @return View
     */
    public function index(): View
    {
        return view('admin.contribution.index');
    }

    /**
     * contribution list
     * @return JsonResponse
     */
    /**
     * contribution info search
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $filter = $request->all();
        $contributions = new Contribution();
        $contributions = $contributions->paginateWithFilter($filter, 10);
        return response()->json($contributions);
    }

    /**
     * add contribution info
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $contribution = new Contribution();
        $contribution->fill($request->all());
        $contribution->save();

        return response()->json(['message' => 'Contribution info added successfully']);
    }
    /**
     * update contribution info
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $contribution = Contribution::find($id);
        $contribution->fill($request->all());
        $contribution->save();

        return response()->json(['message' => 'Contribution info updated successfully']);
    }

    /**
     * delete contribution info
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $user = Contribution::find($id);
        $user->delete();

        return response()->json(['message' => 'Contribution info deleted successfully']);
    }
}
