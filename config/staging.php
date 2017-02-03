<?php
/**
 * @copyright Copyright (c) 1999-2016 netz98 GmbH (http://www.netz98.de)
 *
 * @see LICENSE
 */

namespace Deployer;

use N98\Deployer\RoleManager;

$deployPath = '/var/www/__ADD_DEPLOY_PATH__';

$staging = server('staging', 'staging');
$staging->user('admin');
$staging->configFile('.ssh/config');
$staging->set('deploy_path', $deployPath);
$staging->stage('staging');
$staging->set('config-store-env', 'production');

RoleManager::addServerToRoles('staging', ['web', 'db', 'staging']);