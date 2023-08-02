<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'phone',
        'img_url',
        'position_id',
        'desc'
    ];

    /**
     * paginator for user
     * @param $filter
     * @param $limit
     * @return LengthAwarePaginator
     */
    public function paginateWithFilter($filter, $limit): LengthAwarePaginator
    {
        $query = $this->query()->leftJoin('positions', 'users.position_id', 'positions.id')
                ->selectRaw('
                    users.id,
                    users.position_id,
                    users.name,
                    users.email,
                    users.img_url,
                    users.age,
                    users.phone,
                    positions.name AS position
                ');

        if (isset($filter['name'])) {
            $query->where('users.name', 'LIKE', $filter['name'].'%');
        }

        if (isset($filter['position_id'])) {
            $query->where('users.position_id', $filter['position_id']);
        }

        return $query->orderBy('id', 'DESC')->with('permissions')->paginate($limit);
    }

    /**
     * Returns the count of users based on their positions.
     * @return array
     */
    public function getUsersCount(): array
    {
        $query = $this->query()->leftJoin('positions', 'users.position_id', '=', 'positions.id')
            ->select('users.position_id');

        $leaderCount = clone $query;
        $leaders = $leaderCount->where('users.position_id', config('const.position.Leader'))->count();

        $managerCount = clone $query;
        $managers = $managerCount->where('users.position_id', config('const.position.Manager'))->count();

        $sponsorCount = clone $query;
        $sponsors = $sponsorCount->where('users.position_id', config('const.position.Sponsor'))->count();

        $users = $query->count();
        return [$leaders, $managers, $sponsors, $users];
    }

    /**
     * Returns an array containing the chart data based on the users' positions.
     * The returned array has two keys:
     * - 'labels': An array of position names.
     * - 'data': An array of user counts corresponding to each position.
     * @return array The chart data.
     */
    public function getChartData(): array
    {
        $positions = Position::withCount('users')->get();

        $labels = $positions->pluck('name')->toArray();
        $data = $positions->pluck('users_count')->toArray();

        return ['labels' => $labels, 'data' => $data];
    }

    /**
     * Returns the position of the user.
     * @return BelongsTo
     */
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * user menu description
     * @return string
     */
    public function adminlte_desc(): string
    {
        return $this->desc;
    }

    /**
     * Returns the URL of the AdminLTE profile image.
     * @return string
     */
    public function adminlte_profile_url(): string
    {
        return $this->img_url;
    }
}
