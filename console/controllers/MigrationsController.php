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
    private $namespace;

    public function __construct($id, $module, Migration $migration, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->migration = $migration;
        $this->namespace = '';
    }

    /**
     *  @param array $migrations Migration Classes
     * @param string $method Migration class method
     */
    public function actionInit(array $migrations, string $method)
    {
        foreach ($migrations as $migration) {
            $migration = $this->namespace . ucfirst($migration);
            $object = new $migration($this->migration);
            call_user_func([$object, $method]);
        }
    }

    public function actionEcommerce()
    {
        
    }
}