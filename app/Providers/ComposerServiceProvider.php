<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'home',
            'events/index',
            'settings/create', 'settings/index', 'settings/indext',
            'patients/index', 'patients/create', 'patients/edit', 'patients/trash','patients/show',
            'consultations/index', 'consultations/create', 'consultations/edit', 'consultations/trash','consultations/show',
            'users/index', 'users/create', 'users/edit', 'users/trash','users/show',
            'assistants/index', 'assistants/create', 'assistants/edit', 'assistants/trash','assistants/show',
            'roles/index', 'roles/create', 'roles/edit','roles/show',
        ], 'App\Http\ViewComposers\ProfileComposer');
    }
}
