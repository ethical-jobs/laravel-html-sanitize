<?php

namespace EthicalJobs\Sanitize;

/**
 * Service provider
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Config file path
     *
     * @var string
     */
    protected $configPath = __DIR__ . '/../config/html-sanitize.php';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            $this->configPath => config_path('html-sanitize.php'),
        ], 'config');
    }

    /**
     * Bind Repository interfaces to their appropriate implementations.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom($this->configPath, 'html-sanitize');
    }
}