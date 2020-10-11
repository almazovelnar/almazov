<?php

namespace core\entities\Language;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $code
 * @property string $translate
 * @property bool $status
 *
 * Class Translate
 * @package core\entities\Language
 */
class Translate extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'translates';
    }

    public function getTranslate(): string
    {
        return $this->translate;
    }
}