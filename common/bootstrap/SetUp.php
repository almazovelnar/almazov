<?php

namespace common\bootstrap;


use Yii;
use yii\di\Container;
use yii\base\Application;
use yii\base\BootstrapInterface;
use common\helpers\LanguageHelper;
use core\repositories\TranslateRepository;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = Yii::$container;

        $this->registerComponents($container, $app);
    }

    public function registerComponents(Container $container, Application $app)
    {
        $container->setSingleton(LanguageHelper::class, function (Container $container) use ($app) {
            $translateRepository = $container->get(TranslateRepository::class);
            return new LanguageHelper($translateRepository);
        });
    }
}