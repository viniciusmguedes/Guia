<?php
namespace App\Observers;
use App\Offer;
use App\Product;

class ProductObserver
{
    use UploadObserverTrait;

    protected $field = 'photo';
    protected $path = 'products/';
    public function creating(Product $model)
    {
        $this->sendFile($model);
    }
    public function deleting(Product $model)
    {
        $this->removeFile($model);
    }
    public function updating(Product $model)
    {
        $this->updateFile($model);
    }

}