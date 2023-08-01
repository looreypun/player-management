<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'amount', 'memo'];

    /**
     * paginator for contribution list
     * @param $filter
     * @param $limit
     * @return LengthAwarePaginator
     */
    public function paginateWithFilter($filter, $limit): LengthAwarePaginator
    {
        $query = $this->query();

        if (isset($filter['name'])) {
            $query->where('contributions.name','LIKE', $filter['name'].'%');
        }

        return $query->orderBy('id', 'DESC')->paginate($limit);
    }

    /**
     * Get contributors
     * This method returns the top 10 contributors based on their contribution amount.
     * @return Collection
     */
    public function getContributors(): Collection
    {
        return $this->query()->take(10)->orderBy('amount', 'DESC')->get();
    }

    /**
     * Get chart data for contributions
     * @return array [amounts, dates]
     */
    public function getChartData(): array
    {
        $contributions = $this->query()->select('amount', 'created_at')
            ->orderBy('created_at', 'ASC')
            ->get();

        $monthlyData = [];
        foreach ($contributions as $contribution) {
            $month = Carbon::parse($contribution->created_at)->format('M');
            if (isset($monthlyData[$month])) {
                $monthlyData[$month] += $contribution->amount;
            } else {
                $monthlyData[$month] = $contribution->amount;
            }
        }

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $amounts = [];
        foreach ($months as $month) {
            $amounts[] = isset($monthlyData[$month]) ? $monthlyData[$month] : 0;
        }
        return ['data' => $amounts, 'labels' => $months];
    }
}
