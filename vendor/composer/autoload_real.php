<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitbff831d95a5b1562898717ad2d3e0921
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitbff831d95a5b1562898717ad2d3e0921', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitbff831d95a5b1562898717ad2d3e0921', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitbff831d95a5b1562898717ad2d3e0921::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
