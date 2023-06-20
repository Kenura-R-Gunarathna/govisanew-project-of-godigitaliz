<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Services\Shared\File\FileServiceInterface;
use App\Services\Shared\File\FileService;
use App\Services\Shared\File\StorageServiceInterface;
use App\Services\Shared\File\StorageService;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Laravel\Cashier\Cashier;
use App\Models\Subscription;
use App\Models\SubscriptionItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(StorageServiceInterface::class, function ($app) {
            $disk = Storage::disk('public');
            return new StorageService($disk);
        });

        $this->app->bind(
            FileServiceInterface::class,
            FileService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Cashier::useCustomerModel(User::class);
        Cashier::useSubscriptionModel(Subscription::class);
        //Cashier::useSubscriptionItemModel(SubscriptionItem::class);
    }
}
