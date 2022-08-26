<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $guarded = [];
    public function role()
    {
        return $this->hasOne('App\Role', 'name', 'jabatan');
    }
}
