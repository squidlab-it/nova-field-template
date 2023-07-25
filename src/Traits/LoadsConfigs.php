<?php

namespace Squidlab\NovaFieldTemplate\Traits;

trait LoadsConfigs
{
    /**
     * Loads configs.
     *
     * @param  string  $packageConfigsDir The directory for the packages' config files.
     * @param  bool  $publishConfigs Whether to also automatically make configs publishable.
     **/
    protected function loadConfigs($packageConfigsDir, $publishConfigs = true): void
    {
        $packageConfigsDir = rtrim($packageConfigsDir, DIRECTORY_SEPARATOR);

        if (! is_dir($packageConfigsDir)) {
            return;
        }

        $files = scandir($packageConfigsDir) ?: [];
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && str_ends_with($file, '.php')) {
                if ($this->app->runningInConsole() && $publishConfigs) {
                    $this->publishes([
                        $packageConfigsDir.DIRECTORY_SEPARATOR.$file => config_path($file),
                    ], 'config');
                }

                $namespace = preg_replace('/\.php$/', '', $file) ?: '';
                $this->mergeConfigFrom($packageConfigsDir.DIRECTORY_SEPARATOR.$file, $namespace);
            }
        }
    }
}
