<?php

namespace core\entities;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $code
 * @property string $translate
 * @property bool $status
 * 
 * Class Translate
 * @package core\entities
 */
class Translate extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'translates';
    }
}