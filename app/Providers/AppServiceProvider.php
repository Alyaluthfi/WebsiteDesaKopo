<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Bumdes;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Automatically sync BUMDes from config/bumdes.php to database
        try {
            if (Schema::hasTable('bumdes')) {
                $configList = config('bumdes.list', []);
                foreach ($configList as $item) {
                    Bumdes::updateOrCreate(
                        ['slug' => $item['slug']],
                        $item
                    );
                }
            }
        } catch (\Exception $e) {
            // Fail silently if database is not migrated/ready yet
        }
    }
}
