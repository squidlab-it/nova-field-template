<?php

namespace Squidlab\NovaFieldTemplate\Traits;

use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Nova\Nova;
use Squidlab\NovaFieldTemplate\Providers\FieldServiceProvider;

trait LoadsRoutes
{
    /**
     * Loads configs.
     *
     * @param  string  $packageRoutesDir The directory for the packages' routes files.
     **/
    protected function loadRoutes(string $packageRoutesDir): void
    {
        $packageRoutesDir = rtrim($packageRoutesDir, DIRECTORY_SEPARATOR);

        if (! is_dir($packageRoutesDir)) {
            return;
        }

        $files = scandir($packageRoutesDir) ?: [];

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && str_ends_with($file, '.php')) {
                $namespace = preg_replace('/\.php$/', '', $file) ?: '';

                Route::group($this->routeConfiguration($namespace), function () use ($packageRoutesDir, $file): void {
                    $this->loadRoutesFrom(implode(DIRECTORY_SEPARATOR, [$packageRoutesDir, $file]));
                });
            }
        }
    }

    private function routeConfiguration(string $namespace): array
    {
        $fieldName = Str::slug(FieldServiceProvider::FIELD_NAME);

        return match ($namespace) {
            'nova-api' => [
                'domain' => config('nova.domain', null),
                'as' => 'nova.api.'.$fieldName.'.',
                'prefix' => '/nova-api'.'/'.$fieldName,
                'middleware' => 'nova:api',
                'excluded_middleware' => [SubstituteBindings::class],
            ],
            'nova-web-public' => [
                'domain' => config('nova.domain', null),
                'as' => 'nova.pages.'.$fieldName.'.',
                'prefix' => Nova::path().'/'.$fieldName,
                'middleware' => 'nova',
            ],
            'nova-web' => [
                'domain' => config('nova.domain', null),
                'as' => 'nova.pages.'.$fieldName.'.',
                'prefix' => Nova::path().'/'.$fieldName,
                'middleware' => 'nova:api',
            ],
            'api' => [
                'as' => 'api.'.$fieldName.'.',
                'prefix' => '/api'.'/'.$fieldName,
                'middleware' => 'api',
            ],
            'web' => [
                'as' => $fieldName.'.',
                'middleware' => 'web',
            ],
            default => [
                'as' => $fieldName.'.',
                'middleware' => $namespace,
            ],
        };
    }
}
