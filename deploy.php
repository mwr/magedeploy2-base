<?php
/**
 * @copyright Copyright (c) 2017 Matthias Walter
 * @copyright Copyright (c) 2017 netz98 GmbH (http://www.netz98.de)
 *
 * @see LICENSE
 */
namespace Deployer;

use N98\Deployer\Recipe\Magento2Recipe;
use N98\Deployer\Task\BuildTasks;
use N98\Deployer\Task\DeployTasks;
use N98\Deployer\Task\MagentoTasks;
use N98\Deployer\Task\SystemTasks;

require 'recipe/common.php';

Magento2Recipe::configuration();

/**
 * CONFIGURATION
 */
\Deployer\set('webserver_user', 'www-data');
\Deployer\set('webserver_group', 'www-data');

\Deployer\set('phpfpm_service', 'php7.0-fpm');
\Deployer\set('nginx_service', 'nginx');

\Deployer\set('magento_build_artifacts', ['shop.tar.gz']);

/**
 * SERVERS
 */
$configLocal = __DIR__ . '/config/local.php';
if (is_file($configLocal)) {
    require_once $configLocal;
}
require_once __DIR__ . '/config/staging.php';
require_once __DIR__ . '/config/production.php';

Magento2Recipe::tasks();

/**
 * DEPLOYMENT PIPELINE
 */
desc('Deploy Project');
task(
    'deploy', [
        'deploy:initialize',
        'deploy:prepare',
        'deploy:release',
        BuildTasks::TASK_UPLOAD_ARTIFACTS,
        //BuildTasks::TASK_CHANGE_OWNER_AND_MODE,
        'deploy:shared', // link shared dirs / files
        MagentoTasks::TASK_SYMLINKS_ENABLE,
        'deploy:symlink', // ACTIVATE RELEASE
        MagentoTasks::TASK_MAINTENANCE_MODE_ENABLE,
        MagentoTasks::TASK_CACHE_DISABLE,
        MagentoTasks::TASK_SETUP_UPGRADE,
        //MagentoTasks::TASK_CONFIG_DATA_IMPORT,
        //MagentoTasks::TASK_CMS_DATA_IMPORT,
        MagentoTasks::TASK_CACHE_ENABLE,
        //BuildTasks::TASK_CHANGE_OWNER_AND_MODE,
        'deploy:clear_paths',
        MagentoTasks::TASK_MAINTENANCE_MODE_DISABLE,
        //SystemTasks::TASK_PHP_FPM_RESTART,
        //SystemTasks::TASK_NGINX_RESTART,
        'cleanup',
        'success',
    ]
);

/**
 * Initial Deployment
 */
desc('Server Setup');
task(
    'server:setup', [
        'deploy:initialize',
        'deploy:prepare',
        'deploy:release',
        BuildTasks::TASK_UPLOAD_ARTIFACTS,
        'deploy:shared', // link shared dirs / files
        'deploy:symlink', // ACTIVATE RELEASE
        'deploy:clear_paths',
        'success',
    ]
);

after('deploy:prepare', BuildTasks::TASK_SHARED_DIRS_GENERATE);

// Rollback in case of failure
fail('deploy', DeployTasks::TASK_ROLLBACK);

// @todo we might need to think about downgrading db versions that may have been upgrade during setup_upgrade
// after(DeployTasks::TASK_ROLLBACK, MagentoTasks::TASK_SETUP_DOWNGRADE);
