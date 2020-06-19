<?php

namespace App\Models\Readers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reader extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'lastname',
        'firstname',
        'patronymic',
    ];

    protected $appends = [
        'loan_count'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function loanCount()
    {
        return $this->loans()->count();
    }
}
