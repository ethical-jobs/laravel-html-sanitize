<?php

namespace EthicalJobs\Sanitize;

use HTMLPurifier_Config;
use HTMLPurifier_ConfigSchema;

/**
 * Html purifier static factory
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */
class PurifierFactory
{
    /**
     * Create a new purifier instance
     *
     * @return HTMLPurifier
     */
    public static function create(): HTMLPurifier
    {
        $purifierSettings = static::getPurifierSettings();

        $config = HTMLPurifier_Config::create($purifierSettings);

        $instance = new HTMLPurifier($config);

        $instance->setPreFilters(config('html-sanitize.pre-filters'));

        $instance->setPostFilters(config('html-sanitize.post-filters'));

        return $instance;
    }

    /**
     * Returns the configuration settings for HTML Purifier.
     *
     * @return array
     */
    protected static function getPurifierSettings(): array
    {
        $settings = config('html-sanitize.htmlpurifier', []);

        if (is_array($settings) && count($settings) > 0) {

            if (array_key_exists('Cache.SerializerPath', $settings)) {
                static::validateCachePath($settings['Cache.SerializerPath']);
            }

            return $settings;
        }

        return HTMLPurifier_ConfigSchema::instance()->defaults;
    }

    /**
     * Validates the HTML Purifiers cache path, and creates the folder if it does not exist.
     *
     * @param string $path
     * @return bool
     */
    protected static function validateCachePath(string $path): bool
    {
        if (!is_dir($path)) {
            return mkdir($path);
        }

        return true;
    }
}