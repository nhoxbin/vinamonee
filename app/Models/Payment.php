<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['amt', 'user_id'];
    protected $appends = ['created_date', 'amount'];

    public function getCreatedDateAttribute() {
        return $this->created_at->format('d/m/Y H:i:s');
    }

    public function getAmountAttribute() {
        return number_format($this->amt);
    }

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class);
    }
}
