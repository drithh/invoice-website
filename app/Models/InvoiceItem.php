<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Creating a new class called `InvoiceItem` that extends the `Model` class. */

class InvoiceItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_id',
        'item_id',
    ];

    /**
     * > This function returns the invoice that this payment belongs to
     *
     * @return The invoice that is associated with the payment.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * `->belongsTo(Item::class)` means that the `Item` model is the parent of the `ItemDetail` model
     *
     * @return A collection of all the items that belong to the category.
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
