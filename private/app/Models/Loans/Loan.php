<?php

namespace App\Models\Loans;

use App\Models\Books\Book;
use App\Models\Readers\Reader;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

    /**
     * The attributes that should be visible in serialization.
     *
     * @var array
     */
    protected $visible = [
        'id',
        'book',
        'reader',
        'expires_in',
        'created_at_readable',
        'expires_at_readable',
        'expired'
    ];

    protected $appends = [
        'expires_in',
        'created_at_readable',
        'expires_at_readable',
        'expired'
    ];


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

    public function getExpiresInAttribute()
    {
        return Carbon::now()->diffInDays($this->expires_at);
    }

    public function getCreatedAtReadableAttribute()
    {
        return $this->attributes['created_at'] ? $this->created_at->format('d.m.Y H:i') : '';
    }

    public function getExpiresAtReadableAttribute()
    {
        return $this->attributes['expires_at'] ? $this->expires_at->format('d.m.Y H:i') : '';
    }

    public function getExpiredAttribute()
    {
        return Carbon::now() > $this->expires_at;
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }
}
