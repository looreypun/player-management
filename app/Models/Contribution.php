<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
