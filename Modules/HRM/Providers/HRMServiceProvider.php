<?php

namespace Modules\HRM\Providers;

use Illuminate\Support\ServiceProvider;

class HRMServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerViews();
    }

    /**
     * Register views.
     */
    protected function registerViews(): void
    {
        $viewPath = base_path('Modules/HRM/Views');
        
        // Debug: Check if path exists
        if (!is_dir($viewPath)) {
            throw new \Exception("View path does not exist: {$viewPath}");
        }
        
        $this->loadViewsFrom($viewPath, 'hrm');
        
        // Debug: Log that views are registered
        \Log::info("HRM views registered from: {$viewPath}");
    }
}
