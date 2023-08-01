<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\User;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     * @return View
     */
    public function index(): View
    {
        $user = new User;
        $data = $user->getUsersCount();
        $position_chart = $user->getChartData();

        $contribution = new Contribution;
        $contributors = $contribution->getContributors();
        $contribution_chart = $contribution->getChartData();

        $cards = config('const.cards');
        // default value for now, need to change in future
        $charts = config('const.charts');
        $pages = config('const.pages');

        foreach ($cards as $key => $value) {
            $cards[$key]['number'] = $data[$key];
        }

        return view('home', compact('cards', 'contributors', 'pages', 'charts', 'contribution_chart', 'position_chart'));
    }
}
