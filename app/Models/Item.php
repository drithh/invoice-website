<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/* Creating a new class called Item that extends the Model class. */

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'from_company',
        'price',
        'stock',
        'category',
    ];


    /**
     * > This function returns a collection of InvoiceItem objects that are associated with the Invoice
     * object
     *
     * @return A collection of InvoiceItem objects.
     */
    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    /**
     * A customer can have many invoices.
     *
     * @return A collection of invoices
     */
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }
}
