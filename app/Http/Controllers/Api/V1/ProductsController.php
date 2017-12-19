<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\ApiControllerTrait;
use App\Product;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class ProductsController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required',
        'photo' => 'required',
        'restaurant_id' => 'required'
    ];
    protected $messages = [
        'required' => ':attribute é obrigatório',
        'min' => ':attribute precisa de pelo menos :min caracteres'
    ];

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

}