<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Offer extends Model
{
    protected $fillable = ['price', 'start_date', 'end_date', 'product_id'];
    public function product()
    {
        return $this->belongsTo(\App\Product::class);
    }
}