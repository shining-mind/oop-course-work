<?php

namespace App\Models\Loans;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
    ];

    /**
     * @param mixed $value
     * @return void
     */
    public function setExpiresAtAttribute($value)
    {
        if (is_numeric($value)) {
            $this->attributes['expires_at'] = Carbon::now()->addDays($value)->format($this->getDateFormat());
        } else {
            $this->attributes['expires_at'] = $this->asDateTime($value)->format($this->getDateFormat());
        }
    }
}
