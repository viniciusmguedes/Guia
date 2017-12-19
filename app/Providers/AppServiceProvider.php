<?php

namespace App\Providers;

use App\Address;
use App\Observers\RestaurantVoteObserver;
use App\Product;
use App\Restaurant;
use App\RestaurantPhoto;
use App\Observers\ProductObserver;
use App\Observers\RestaurantObserver;
use App\Observers\RestaurantPhotoObserver;
use App\Observers\AddressObserver;
use App\RestaurantVote;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(){
        Address::observe(AddressObserver::class);
        Product::observe(ProductObserver::class);
        Restaurant::observe(RestaurantObserver::class);
        RestaurantPhoto::observe(RestaurantPhotoObserver::class);
        RestaurantVote::observe(RestaurantVoteObserver::class);


    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
