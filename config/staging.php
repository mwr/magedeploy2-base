<?php
/**
 * @copyright Copyright (c) 2017 Matthias Walter
 * @copyright Copyright (c) 2017 netz98 GmbH (http://www.netz98.de)
 *
 * @see LICENSE
 */

namespace Deployer;

$deployPath = '/var/www/__ADD_DEPLOY_PATH__';

$staging = host('staging');
$staging->configFile('.ssh/config');
$staging->stage('staging');
$staging->set('deploy_path', $deployPath);
$staging->set('config_store_env', 'staging');
$staging->roles('web', 'db', 'staging');