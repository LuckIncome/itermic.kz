<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{

    /**
     * Привязка политик для приложения.
     *
     * @var array
     */
    protected $policies = [
      \App\Models\Roles::class => \App\Policies\RolesPolicy::class,
      \App\Models\User::class => \App\Policies\UsersPolicy::class,
      \App\Models\Langs::class => \App\Policies\LangsPolicy::class,
      \App\Models\Templates::class => \App\Policies\TemplatesPolicy::class,
      \App\Models\Sections::class => \App\Policies\SectionsPolicy::class,
      \App\Models\News::class => \App\Policies\NewsPolicy::class,
      \App\Models\Settings::class => \App\Policies\SettingsPolicy::class,
      \App\Models\Rubrics::class => \App\Policies\RubricsPolicy::class,
      \App\Models\Menu::class => \App\Policies\MenuPolicy::class,
      \App\Models\Links::class => \App\Policies\LinksPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
