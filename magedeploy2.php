<?php
/**
 * @copyright Copyright (c) 2017 Matthias Walter
 *
 * @see LICENSE
 */

return [
    'env' => [
        'git_bin' => '/usr/local/bin/git',
        'php_bin' => '/usr/local/bin/php',
        'tar_bin' => '/usr/local/bin/gtar',
        'composer_bin' => '/usr/local/bin/composer.phar',
        'deployer_bin' => '/usr/local/bin/deployer.phar'
    ],
    'deploy' => [
        'git_url' => '__SET_GIT_URL__', // @todo set git url
        'git_dir' => 'shop',
        'magento_dir' => 'shop/src', // @todo set git repo sub-dir if necessary
        'themes' => [  // @todo adjust to your projects needs
            'Magento/luma' => [
                'de_DE',
            ],
            'Magento/backend' => [
                'de_DE',
                'en_US',
            ],
        ],
        'assets' => [
            'var_di.tar.gz' => ['dir' => 'src/var/di'],
            'var_generation.tar.gz' => ['dir' => 'src/var/generation'],
            'pub_static.tar.gz' => ['dir' => 'src/pub/static'],
            'shop.tar.gz' => [
                'dir' => 'src',
                'options' => [
                    '--exclude-vcs',
                    // '--exclude-from=artifact.ignore',
                    '--checkpoint=5000',
                ],
            ],
        ],
        'clean_dirs' => [
            'var/cache',
            'var/di',
            'var/generation',
        ],
    ],
    'magento' => [
        'db' => [
            'admin-email' => 'admin@mwltr.de',
            'admin-firstname' => 'Admin',
            'admin-lastname' => 'Admin',
            'admin-password' => 'admin123',
            'admin-user' => 'admin',
            'backend-frontname' => 'admin',
            'base-url' => 'http://magedeploy2_dev',
            'base-url-secure' => 'https://magedeploy2_dev',
            'currency' => 'EUR',
            'db-host' => '127.0.0.1',
            'db-name' => 'magedeploy2_dev',
            'db-password' => '',
            'db-user' => 'root',
            'language' => 'en_US',
            'session-save' => 'files',
            'timezone' => 'Europe/Berlin',
            'use-rewrites' => '1',
            'use-secure' => '0',
            'use-secure-admin' => '0',
        ],
    ],
];