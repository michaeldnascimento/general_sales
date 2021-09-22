<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit627f95b8d704953998cef695af67cd53
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit627f95b8d704953998cef695af67cd53::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit627f95b8d704953998cef695af67cd53::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit627f95b8d704953998cef695af67cd53::$classMap;

        }, null, ClassLoader::class);
    }
}
