<?php

namespace core\entities;


use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string $thumb
 * @property int $sort
 * @property bool $is_default
 * @property string $created_at
 * @property string $code
 * @property bool $status
 * @property integer $user_id
 *
 *
 * Class Language
 * @package core\entities
 */
class Language extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'languages';
    }

}