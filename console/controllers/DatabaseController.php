<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Exception;

/**
 * Class DatabaseController
 * @package console\controllers
 */
class DatabaseController extends Controller
{
    private $mysql;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->mysql = Yii::$app->db;
    }

    public function actionInit()
    {
        $this->initTables();
    }

    private function initTables()
    {
        try {
            $this->mysql->createCommand()->insert('pages', [
                'name' => 'root',
                'lft' => 1,
                'rgt' => 2,
                'depth' => 0,
                'parent' => 0,
                'status' => 0,
                'module' => 'root'
            ])->execute();
            echo "Root for pages created" . PHP_EOL;

            /***********/

            $this->mysql->createCommand()->insert('categories', [
                'name' => 'root',
                'lft' => 1,
                'rgt' => 2,
                'depth' => 0,
                'parent' => 0,
                'status' => 0
            ])->execute();
            echo "Root for product categories created" . PHP_EOL;

            /***********/

            $this->mysql->createCommand()->insert('brands', [
                'name' => 'root',
                'lft' => 1,
                'rgt' => 2,
                'depth' => 0,
                'parent' => 0,
                'status' => 0
            ])->execute();
            echo "Root for product brands created" . PHP_EOL;

            /***********/

            $this->mysql->createCommand()->insert('main_info', [
                'name' => 'New Project'
            ])->execute();
            echo "Project information created" . PHP_EOL;

            $this->initConfigs();
            echo "Configs created" . PHP_EOL;
        } catch (Exception $e) {
            Yii::$app->errorHandler->logException($e);
            echo $e->getMessage() . PHP_EOL;
        }
    }

    private function initConfigs()
    {
        $this->mysql->createCommand()->batchInsert('configs', [
            'name', 'value', 'label'
        ], [
            ['FACEBOOK', '#', 'Facebook Page Url'],
            ['INSTAGRAM', '#', 'Instagram Page Url'],
            ['YOUTUBE', '#', 'Youtube Channel Url'],
            ['TWITTER', '#', 'Twitter Page Url'],
            ['LINKEDIN', '#', 'Linkedin Page Url'],
            ['TWITTER', '#', 'Twitter Page Url']
        ])->execute();
    }
}