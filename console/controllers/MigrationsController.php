<?php

namespace console\controllers;

use Yii;
use Exception;
use yii\console\Controller;
use console\services\MigrationService;

/**
 * Class MigrationsController
 * @package console\controllers
 */
class MigrationsController extends Controller
{
    private $migrationService;

    public function __construct($id, $module, MigrationService $migrationService, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->migrationService = $migrationService;
    }

    /**
     * @param array $migrations Migration Classes
     * @param string $method Migration class method
     */
    public function actionInit(array $migrations, string $method = 'up')
    {
        try {
            foreach ($migrations as $migration) {
                $this->migrationService->create($migration, $method);
            }
        } catch (Exception $e) {
            Yii::$app->errorHandler->logException($e);
            echo PHP_EOL . $e->getMessage();
        }
    }

    /**
     * Base migrations
     */
    public function actionBase()
    {
        $migrations = ['mainInfo', 'page', 'language', 'translate', 'config', 'slider', 'request'];

        try {
            foreach ($migrations as $migration) {
                $this->migrationService->create($migration);
            }
        } catch (Exception $e) {
            Yii::$app->errorHandler->logException($e);
            echo PHP_EOL . $e->getMessage();
        }
    }
}