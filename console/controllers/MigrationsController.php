<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Migration;

/**
 * Class MigrationsController
 * @package console\controllers
 */
class MigrationsController extends Controller
{
    private $migration;

    public function __construct($id, $module, Migration $migration, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->migration = $migration;
    }

    public function actionInit(array $migrations, string $type)
    {
        $path = Yii::getAlias('core\migrations\\');

        foreach ($migrations as $migration) {
            $migration = $path . ucfirst($migration);
            $object = new $migration($this->migration);
            call_user_func([$object, $type]);
        }
    }
}