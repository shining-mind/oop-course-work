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
        'deleted'
    ];

    protected $appends = [
        'loan_count',
        'deleted'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function loanCount()
    {
        return $this->loans()->count();
    }

    public function getDeletedAttribute()
    {
        return !is_null($this->deleted_at);
    }
}
