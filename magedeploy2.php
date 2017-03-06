<?php

return [
    'env' => [
        'git_bin' => '/usr/local/bin/git',
        'php_bin' => '/usr/local/bin/php',
        'tar_bin' => '/usr/local/bin/gtar',
        'composer_bin' => '/usr/local/bin/composer.phar',
        'deployer_bin' => './vendor/bin/dep',
    ],
    'deploy' => [
        'git_url' => '__SET_GIT_URL__', // @todo set git url
        'git_dir' => 'shop',
        'app_dir' => 'shop',
        'artifacts_dir' => 'artifacts',
        'themes' => [
            [
                'code' => 'Magento/backend',
                'languages' => [
                    'en_US',
                ],
            ],
            [
                'code' => 'Magento/luma',
                'languages' => [
                    'en_US',
                ],
            ],
        ],
        'assets' => [
            'var_di.tar.gz' => [
                'dir' => 'var/di',
            ],
            'var_generation.tar.gz' => [
                'dir' => 'var/generation',
            ],
            'pub_static.tar.gz' => [
                'dir' => 'pub/static',
            ],
            'shop.tar.gz' => [
                'dir' => '.',
                'options' => [
                    '--exclude-vcs',
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
    'build' => [
        'db' => [
            'db-host' => '127.0.0.1',
            'db-name' => 'magedeploy2_dev',
            'db-user' => 'root',
            'db-password' => 'root',
            'admin-email' => 'admin@mwltr.de',
            'admin-firstname' => 'Admin',
            'admin-lastname' => 'Admin',
            'admin-password' => 'admin123',
            'admin-user' => 'admin',
            'backend-frontname' => 'admin',
            'base-url' => 'http://magedeploy2_dev',
            'base-url-secure' => 'https://magedeploy2_dev',
            'currency' => 'EUR',
            'language' => 'en_US',
            'session-save' => 'files',
            'timezone' => 'Europe/Berlin',
            'use-rewrites' => '1',
            'use-secure' => '0',
            'use-secure-admin' => '0',
        ],
    ],
];