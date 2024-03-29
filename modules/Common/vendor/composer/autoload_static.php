<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2ed3ae90d3f443d1cebce8ebe57cf61f
{
    public static $files = array (
        '12aaa27c81d85ef3f8df8310a36ce7fb' => __DIR__ . '/../..' . '/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Common\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Common\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2ed3ae90d3f443d1cebce8ebe57cf61f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2ed3ae90d3f443d1cebce8ebe57cf61f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2ed3ae90d3f443d1cebce8ebe57cf61f::$classMap;

        }, null, ClassLoader::class);
    }
}
