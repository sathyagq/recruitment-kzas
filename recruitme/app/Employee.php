<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees';

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone',
        'cpf'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
