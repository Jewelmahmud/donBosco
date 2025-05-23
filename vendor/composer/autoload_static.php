<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb2e8b17b7bf14503f0c9e0dffbd1b062
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mollie\\Api\\' => 11,
        ),
        'C' => 
        array (
            'Composer\\CaBundle\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mollie\\Api\\' => 
        array (
            0 => __DIR__ . '/..' . '/mollie/mollie-api-php/src',
        ),
        'Composer\\CaBundle\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/ca-bundle/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb2e8b17b7bf14503f0c9e0dffbd1b062::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb2e8b17b7bf14503f0c9e0dffbd1b062::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb2e8b17b7bf14503f0c9e0dffbd1b062::$classMap;

        }, null, ClassLoader::class);
    }
}
