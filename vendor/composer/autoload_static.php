<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit895b5f788c851aaf157d67e3ec552073
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit895b5f788c851aaf157d67e3ec552073::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit895b5f788c851aaf157d67e3ec552073::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit895b5f788c851aaf157d67e3ec552073::$classMap;

        }, null, ClassLoader::class);
    }
}
