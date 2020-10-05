<?php

namespace console\services;


use yii\db\Migration;

/**
 * Class MigrationService
 * @package console\services
 */
class MigrationService
{
    private $migration;
    private $namespace;

    public function __construct(Migration $migration)
    {
        $this->namespace = 'console\models\migrations\\';

        $this->migration = $migration;
    }

    public function create(string $migration, string $method = 'up')
    {
        $migration = $this->namespace . ucfirst($migration);
        $object = new $migration($this->migration);
        call_user_func([$object, $method]);
    }
}