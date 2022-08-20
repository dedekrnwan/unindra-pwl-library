<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTurnover extends Model
{
    use HasFactory;

    protected $table = 'book_turnovers';


    protected $fillable = [
        'book_id',
        'user_id',
        'user_loan_id',
        'cash_amount',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user_loan()
    {
        return $this->belongsTo(userLoan::class, 'user_loan_id', 'id');
    }
}
