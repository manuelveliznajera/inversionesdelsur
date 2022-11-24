<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['loan_id','diapago', 'date', 'number', 'payment', 'interest', 'amort', 'balance'];
  
    public function formateDate()
{
    return $this->created_at->format('M d Y');
}
}
