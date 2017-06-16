<?php
/**
 * @copyright Copyright (c) 2017 Matthias Walter
 * @copyright Copyright (c) 2017 netz98 GmbH (http://www.netz98.de)
 *
 * @see LICENSE
 */

namespace Deployer;

use N98\Deployer\RoleManager;

$deployPath = '/var/www/__ADD_DEPLOY_PATH__';
$sshConfigFile = '.ssh/config';

// Frontend Web Server 01
$production = host( 'web01');
$production->hostname('web01');
$production->configFile($sshConfigFile);
$production->stage('production');
$production->set('deploy_path', $deployPath);
$production->set('config_store_env', 'production');

// Admin Server running crons, sftp and in the future the admin-panel
$production = host('admin01');
$production->hostname('admin01');
$production->configFile($sshConfigFile);
$production->stage('production');
$production->set('deploy_path', $deployPath);
$production->set('config_store_env', 'production');

RoleManager::addServerToRoles('web01', ['web', 'production']);
RoleManager::addServerToRoles('admin01', ['web', 'db', 'production']);

