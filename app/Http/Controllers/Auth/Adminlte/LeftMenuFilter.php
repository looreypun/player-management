<?php

namespace App\Http\Controllers\Auth\Adminlte;

use Illuminate\Contracts\Auth\Access\Gate;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

class LeftMenuFilter implements FilterInterface
{
    protected $gate;

    public function __construct(Gate $gate)
    {
        $this->gate = $gate;
    }

    public function transform($item)
    {
        if (! $this->isVisible($item)) {
            return false;
        }

        return $item;
    }


    protected function isVisible($item)
    {
        if (! isset($item['permission'])) {
            return true;
        }

        if (isset($item['model'])) {
            foreach ($item['permission'] as $value) {
                if ($this->gate->allows($value, $item['model'])) {
                    return true;
                }
            }
            return false;
        }

        foreach ($item['permission'] as $value) {
            if ($this->gate->allows($value)) {
                return true;
            }
        }

        return false;
    }
}