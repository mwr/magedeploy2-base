<?php
/**
 * @copyright Copyright (c) 2017 Matthias Walter
 * @copyright Copyright (c) 2017 netz98 GmbH (http://www.netz98.de)
 *
 * @see LICENSE
 */

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Mwltr\MageDeploy2\Robo\RoboFile
{
    public function magentoCleanVarDirs()
    {
        $this->startTimer();

        $this->taskMagentoCleanVarDirs()->run();

        $this->stopTimer();
        $this->printRuntime(__FUNCTION__);
    }

    public function magentoUpdateDependencies()
    {
        $this->taskMagentoUpdateDependencies()->run();
    }

    public function magentoSetProductionMode()
    {
        $this->taskMagentoSetProductionMode()->run();
    }

    public function magentoSetupStaticContentDeploy()
    {
        $this->taskMagentoSetupStaticContentDeploy()->run();
    }

    public function magentoArtifactsCreatePackages()
    {
        $this->taskArtifactCreatePackages()->run();
    }

    public function testTest()
    {
        /** @var \Mwltr\MageDeploy\Robo\Task\UpdateSourceCodeTask $task */
        $task = $this->task(\Mwltr\MageDeploy\Robo\Task\UpdateSourceCodeTask::class);
        $task->tag('develop');
        $task->run();
    }
    
}