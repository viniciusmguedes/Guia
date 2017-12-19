<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'photo', 'price','restaurant_id'];
    protected $appends = ['photo_full_url'];

    protected function getPhotoFullUrlAttribute()
    {
        if (!empty($this->attributes['photo'])) {
            return 'https://s3-'.env('AWS_REGION').'.amazonaws.com/'.env('AWS_BUCKET').'/products/'.$this->attributes['photo'];
        } else {
            return null;
        }
    }
    public function Offer()
    {
        return $this->hasOne(\App\Offer::class);
    }
}