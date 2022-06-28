<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* This is a class declaration. It is saying that the class Invoice extends the Model class. */

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


    /**
     * When creating a new invoice, set the invoice number to INV-{user_id}-{invoice_count} and the link to
     * the invoice number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->invoice_number = 'INV-' . $model->user_id . '-' . str_pad(Invoice::count() + 1, 5, "0", STR_PAD_LEFT);
            $model->link = $model->invoice_number;
        });
    }


    /**
     * > This function returns a collection of all the invoice items associated with this invoice
     *
     * @return A collection of InvoiceItem objects.
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * > This function returns the user that owns the phone
     *
     * @return A collection of all the replies associated with the question.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
