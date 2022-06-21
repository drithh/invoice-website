<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'invoice_number',
        'invoice_date',
        'link',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->invoice_number = 'INV-' . $model->user_id . '-' . str_pad(Invoice::count() + 1, 5, "0", STR_PAD_LEFT);
            $model->link = $model->invoice_number;
        });
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
