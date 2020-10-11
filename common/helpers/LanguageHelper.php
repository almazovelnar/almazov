<?php

namespace common\helpers;

use Yii;
use yii\caching\CacheInterface;
use core\entities\Language\Translate;

/**
 * Class LanguageHelper
 * @package common\helpers
 */
class LanguageHelper
{
    public CacheInterface $cache;

    public function __construct()
    {
        $this->cache = Yii::$app->cache;
    }

    public static function t(string $code)
    {
        $static = new self();
        return $static->cache->getOrSet('translate_' . $code, function () use ($code) {
            $result = Translate::find()->where(['code' => $code, 'language' => Yii::$app->language])->one();
            /** @var Translate $result */
            return $result == null ? $code . '__NT' : $result->getTranslate();
        });
    }
}