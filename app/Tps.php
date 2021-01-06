<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    protected $guarded = [];

    /**
     * Get The Users For the TPS
     */
    public function users()
    {
        return $this->hasMany('App\Users');
    }
}
