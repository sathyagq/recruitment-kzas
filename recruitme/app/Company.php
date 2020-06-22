<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'email',
        'logo_url',
        'website'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
