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
$production = server('web01', 'web01');
$production->user('admin');
$production->configFile($sshConfigFile);
$production->set('deploy_path', $deployPath);
$production->stage('production');
$production->set('config_store_env', 'production');

// Admin Server running crons, sftp and in the future the admin-panel
$production = server('admin01', 'admin01');
$production->user('admin');
$production->configFile($sshConfigFile);
$production->set('deploy_path', $deployPath);
$production->stage('production');
$production->set('config_store_env', 'production');

RoleManager::addServerToRoles('web01', ['web', 'production']);
RoleManager::addServerToRoles('admin01', ['web', 'db', 'production']);

