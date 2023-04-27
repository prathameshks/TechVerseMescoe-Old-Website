<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit74a4fbdf409fcdab40383147bd1c8b1b
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit74a4fbdf409fcdab40383147bd1c8b1b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit74a4fbdf409fcdab40383147bd1c8b1b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit74a4fbdf409fcdab40383147bd1c8b1b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}