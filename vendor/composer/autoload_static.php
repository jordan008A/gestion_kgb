<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit67f9c9d31534e505e20f0c0f92b7a46e
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit67f9c9d31534e505e20f0c0f92b7a46e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit67f9c9d31534e505e20f0c0f92b7a46e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit67f9c9d31534e505e20f0c0f92b7a46e::$classMap;

        }, null, ClassLoader::class);
    }
}
