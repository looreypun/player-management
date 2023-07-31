<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query = User::leftJoin('positions', 'users.position_id', '=', 'positions.id')
            ->select('users.position_id');

        $leaderCount = clone $query;
        $leader = $leaderCount->where('users.position_id', config('const.position.Leader'))->count();

        $managerCount = clone $query;
        $manager = $managerCount->where('users.position_id', config('const.position.Manager'))->count();

        $sponsorCount = clone $query;
        $sponsor = $sponsorCount->where('users.position_id', config('const.position.Sponsor'))->count();

        $totalUsers = $query->count();

        $data = [
            [
                'icon' => 'user-tie',
                'subtitle' => 'LEADERS',
                'number' => $leader,
                'stats' => 'For this Week',
                'bg_color' => 'bg-dark',
            ],
            [
                'icon' => 'olive fas fa-money-bill-alt',
                'subtitle' => 'MANAGERS',
                'number' => $manager,
                'stats' => 'For this Month',
                'bg_color' => 'bg-info',
            ],
            [
                'icon' => 'fa-solid fa-circle-dollar-to-slot',
                'subtitle' => 'SPONSERS',
                'number' => $sponsor,
                'stats' => 'For this Month',
                'bg_color' => 'bg-secondary',
            ],
            [
                'icon' => 'orange fas fa-envelope',
                'subtitle' => 'TOTAL USERS',
                'number' => $totalUsers,
                'stats' => 'For this week',
                'bg_color' => 'bg-danger',
            ],
        ];

        $contributors = [
            [
                'name' => 'Albers',
                'amount' => '27,340',
            ],
            [
                'name' => 'Madan',
                'amount' => '21,280',
            ],
            [
                'name' => 'Kristan',
                'amount' => '18,210',
            ],
            [
                'name' => 'Himal',
                'amount' => '15,176',
            ],
            [
                'name' => 'Rabin',
                'amount' => '14,276',
            ],
            [
                'name' => 'Sajan',
                'amount' => '13,176',
            ],
            [
                'name' => 'Yogesh',
                'amount' => '12,176',
            ],
            [
                'name' => 'Bishal',
                'amount' => '11,886',
            ],
            [
                'name' => 'Shahil',
                'amount' => '11,509',
            ],
            [
                'name' => 'Prabin',
                'amount' => '1,700',
            ],
        ];

        $pages = [
            [
                'page_name' => '/about.html',
                'visitors' => '8,340',
            ],
            [
                'page_name' => '/special-promo.html',
                'visitors' => '7,280',
            ],
            [
                'page_name' => '/products.html',
                'visitors' => '6,210',
            ],
            [
                'page_name' => '/documentation.html',
                'visitors' => '5,176',
            ],
            [
                'page_name' => '/customer-support.html',
                'visitors' => '4,276',
            ],
            [
                'page_name' => '/index.html',
                'visitors' => '3,176',
            ],
            [
                'page_name' => '/products-pricing.html',
                'visitors' => '2,176',
            ],
            [
                'page_name' => '/product-features.html',
                'visitors' => '1,886',
            ],
            [
                'page_name' => '/contact-us.html',
                'visitors' => '1,509',
            ],
            [
                'page_name' => '/terms-and-condition.html',
                'visitors' => '1,100',
            ],
        ];

        return view('home', compact('data', 'contributors', 'pages'));
    }
}
