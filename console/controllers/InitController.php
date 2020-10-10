<?php

namespace console\controllers;

use yii\console\Controller;

/**
 * Class InitController
 * @package console\controllers
 */
class InitController extends Controller
{
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
    }
}