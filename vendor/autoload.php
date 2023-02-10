<?php

// autoload.php @generated by Composer

if (PHP_VERSION_ID < 50600) {
    if (!headers_sent()) {
        header('HTTP/1.1 500 Internal Server Error');
    }
    $err = 'Composer 2.3.0 dropped support for autoloading on PHP <5.6 and you are running '.PHP_VERSION.', please upgrade PHP or use Composer 2.2 LTS via "composer self-update --2.2". Aborting.'.PHP_EOL;
    if (!ini_get('display_errors')) {
        if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
            fwrite(STDERR, $err);
        } elseif (!headers_sent()) {
            echo $err;
        }
    }
    trigger_error(
        $err,
        E_USER_ERROR
    );
}

require_once __DIR__ . '/composer/autoload_real.php';

<<<<<<< HEAD
<<<<<<< HEAD
return ComposerAutoloaderInit062af4ea7572b5558ffb82f77f7152e3::getLoader();
=======
return ComposerAutoloaderInit7dc8f35e91e1feed8ca09f13f8e94c7e::getLoader();
>>>>>>> borja
=======
return ComposerAutoloaderInit4145b2654a16c8bf5ab29aba49aea300::getLoader();
>>>>>>> borja
