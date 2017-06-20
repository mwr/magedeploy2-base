# UPGRADE GUIDE

## upgrade from 1.0 to 2.0

Starting version 2.0 magedeploy2-base is only compatible with deployer > 5.0.x.
A detailed instruction on how to migrate your individualized deployer setup 
can be found here: https://github.com/deployphp/deployer/blob/master/UPGRADE.md

The important parts for the standard magedeploy2 setup are as follows.

### update composer.json

update your composer.json to include deployer 5 and n98-deployer 2.

    "deployer/deployer": "^5.0",
    "n98/n98-deployer": "^2.0"

### update config

The definitions for servers has changed in deployer 5.
Use ``host`` in stead of ``server`` function. And be aware of the parameter change.
You no longer can provide an alias for the server.

For ``local.php`` change ``localServer`` to ``local``.

If you have some special setup in your config, refer to the above mentioned upgrade guide in the deployer repository

Change the roles usage from RoleManager to deployer 5 roles.

From: 

`RoleManager::addServerToRoles('production', ['web', 'db', 'production']);`

To: 

`$host->roles('web', 'db', 'production');`

### update deploy.php

Change the ``onFailure`` definition to ``fail``.

Update deploy pipeline and remove ``CleanupTasks`` from the list.

### task restrictions

in case you have some special task restrictions, you now have to use one of these methods:
- onlyOn
- onlyOnStages
- onRoles

### credentials

In deployer 5 it is best practice to use an ssh/config file for credentials.
Since that is the approach magedeploy2 uses there is nothing to do here.

Be aware that deployer 5 is only supporting native ssh implementation.
