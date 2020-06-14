<?php

namespace WaterAdmin\Concerns;

trait RelativeClassName
{
    /**
     * The class namespaces prefix.
     *
     * @var array
     */
    public static $namespaces = [];

    /**
     * The class namespaces prefix pattern.
     *
     * @var string|null
     */
    public static $namespacesPattern;

    /**
     * Add class namespace prefix.
     *
     * @param  string  $prefix
     * @return void
     */
    public static function addClassNamespace(string $prefix)
    {
        static::$namespaces[] = $prefix;
    }

    /**
     * Get the class namespaces prefix pattern.
     *
     * @return string
     */
    public static function getNamespacesPattern()
    {
        if (! static::$namespacesPattern && count(static::$namespaces)) {
            static::$namespacesPattern = collect(static::$namespaces)
                ->map(function ($namespacePrefix) {
                    return str_replace('/', '\\', trim($namespacePrefix, '/\\'));
                })
                ->map(function ($namespacePrefix) {
                    return str_replace('\\', '\\\\', $namespacePrefix).'\\\\';
                })
                ->implode('|');

            static::$namespacesPattern = '/^('.static::$namespacesPattern.')/';
        }

        return static::$namespacesPattern;
    }

    /**
     * Get relative class name.
     *
     * @return string
     */
    public function getRelativeClassName()
    {
        return preg_replace(static::getNamespacesPattern(), '', get_class($this));
    }
}