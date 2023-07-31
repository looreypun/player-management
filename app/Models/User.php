<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * This class represents a user in the application.
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'img_url',
        'age',
        'position_id',
        'phone'
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
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
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
    public function adminlte_desc()
    {
        return $this->email;
    }

    public function adminlte_profile_url()
    {
        return $this->img_url;
    }
}
