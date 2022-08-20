<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoan extends Model
{
    use HasFactory;

    protected $table = 'user_loans';

    protected $fillable = [
        'effective_date',
        'expired_date',
        'book_id',
        'user_id',
        'quantity',
        'status', //borrowed, returned, lost
        'return_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function book_turnover()
    {
        return $this->hasOne(BookTurnover::class, 'user_loan_id', 'id');
    }
}
