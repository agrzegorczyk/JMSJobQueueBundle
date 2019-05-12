<?php

namespace JMS\JobQueueBundle\Cron;

use JMS\JobQueueBundle\Console\CronCommand;
use JMS\JobQueueBundle\Entity\Job;

class CommandScheduler implements JobScheduler
{
    private $name;
    private $command;

    public function __construct(string $name, CronCommand $command)
    {
        $this->name = $name;
        $this->command = $command;
    }

    public function getCommands(): array
    {
        return [$this->name];
    }

    public function shouldSchedule(\DateTime $lastRunAt)
    {
        return $this->command->shouldBeScheduled($lastRunAt);
    }

    public function createJob(\DateTime $lastRunAt)
    {
        return $this->command->createCronJob($lastRunAt);
    }
}
