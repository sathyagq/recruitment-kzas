<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'adresses';

    protected $fillable = [
        'employee_id',
        'cep',
        'street',
        'number',
        'neighborhood',
        'city',
        'state',
        'complement',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
