<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit362545fb4110a04e748b450af7cf94e5
{
    public static $prefixesPsr0 = array (
        'B' => 
        array (
            'Bramus' => 
            array (
                0 => __DIR__ . '/..' . '/bramus/router/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit362545fb4110a04e748b450af7cf94e5::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
