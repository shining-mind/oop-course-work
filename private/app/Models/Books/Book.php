<?php

namespace App\Models\Books;

use App\Models\Loans\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'name',
        'author',
        'condition'
    ];

    public function loan()
    {
        return $this->hasOne(Loan::class);
    }
}
