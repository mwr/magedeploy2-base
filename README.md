# MageDeploy2 Base

Magento2 Deployment Setup using Robo and Deployer. 
This is the base project you should base your deployments on.
It provides an configurable and customizable setup to create push deployments for Magento2.

## Getting Started

### Requirements

 * deployer/deployer
 * consolidation/robo
 * mwltr/magedeploy2
 * netz98/n98-deployer

### Prerequisites

MageDeploy2 requires deployer and robo to be available on your system.

Those Tools can be used globaly or added as a requirement to your local composer.json.

The path to those tools can be configured in the magedeploy2.php

### Installation

Create a new deployment setup

```
composer create-project mwltr/magedeploy2-base <dir>
```

Robo needs to be installed using composer, otherwise the usage of custom Tasks is not available.
See the Robo Documentation [Including Additional Tasks](http://robo.li/extending/#including-additional-tasks)

### Configure Deployment

After the Installation you have to edit the `magedeploy2.php` and the `deploy.php` file to suit your needs.
This tool assumes you have a git repository containing the magento composer.json. 
Furthermore your local build environment can clone said repository and download the Magento packages using composer.  

To configure the MageDeploy2 use the following command:

```
./vendor/bin/robo config:init
```

It will guide you throught the most important configuration options. 
Don't worry you can edit the magedeploy2.php lateron.

Next, run 
```
./vendor/bin/robo validate
```
to validate your build environment is setup.

## CONFIGURATION FILES

### magedeploy2.php

This is the config file to set all parameters required for the deployment in general.

The most common settings are to adjust on a project basis:

 - deploy/git_url (path to your git repository)
 - deploy/themes (the themes that are to be generated)
 - build/db (the database settings for the build environment)

A complete list of configuration options is provided further down.

#### env

| Key          | Description                 | Default                      |                        
| ------------ | --------------------------- | ---------------------------- |
| git_bin      | Path to git executable      | /usr/local/bin/git           |
| php_bin      | Path to php executable      | /usr/local/bin/php           |
| tar_bin      | Path to tar executable      | /usr/local/bin/gtar          |
| composer_bin | Path to composer executable | /usr/local/bin/composer.phar |
| deployer_bin | Path to deployer executable | /usr/local/bin/deployer.phar |

#### deploy

| Key           | Description                                                   | Default   |                        
| ------------- | ------------------------------------------------------------- | --------- |
| git_url       | Git-Url to your repository                                    |           |
| git_dir       | Sub-directory on build server to clone the repository to      | shop      |
| app_dir       | If you have your magento composer.json in another sub-dir     |           |
| themes        | An array of themes to compile                                 |           |
| assets        | List of assets to generate                                    |           |
| clean_dirs    | list of dirs to clean on each deployment                      |           |

#### build/db

Contains the database configuration being used to create and update a local magento setup during deployment.

### deploy.php

This file is for the actual deployment of your project to the server.
It has a basic setup that should work on most of the environments.
You can adjust this to your needs as well.
Leave out unwanted steps, add new ones, exchange existing ones, etc.

The `deploy.php` uses the `N98\Deploy\Recipe\Magento2Recipe` as base recipe and overwrites some of the default settings.

The server configuration is defined using the `config/*.php` files.

## COMMANDS

### config:init

Generate a new magedeploy2.php. Be aware: this will overwrite your existing configuration

### validate

Validates that 
- the bin config values are execuatble,
- the git repository is reachable

### deploy

Triggers the deployment with all it's stages

## Versioning

We use [SemVer](http://semver.org/) for versioning. 
For the versions available, see the [tags on this repository](https://github.com/mwr/magedeploy2-skeleton/tags). 

## Authors

* **Matthias Walter** - *Initial work* - [mwr](https://github.com/mwr)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
