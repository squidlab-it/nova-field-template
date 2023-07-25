<?php

namespace Squidlab\NovaFieldTemplate\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Squidlab\NovaFieldTemplate\Traits\LoadsConfigs;
use Squidlab\NovaFieldTemplate\Traits\LoadsRoutes;
use Squidlab\NovaFieldTemplate\Traits\LoadsTranslations;

class FieldServiceProvider extends ServiceProvider
{
    public const FIELD_NAME = 'vue3-field';

    use LoadsTranslations;
    use LoadsConfigs;
    use LoadsRoutes;

    public function register()
    {
    }

    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script(self::FIELD_NAME, __DIR__.'/../../dist/js/field.js');
            Nova::style(self::FIELD_NAME, __DIR__.'/../../dist/css/field.css');
        });

        $this->loadTranslations(__DIR__.'/../../resources/lang', self::FIELD_NAME);

        $this->loadConfigs(__DIR__.'/../../config');

        $this->loadRoutes(__DIR__.'/../../routes');
    }
}
