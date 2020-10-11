<?php

namespace core\repositories;

use yii\db\ActiveQuery;
use core\entities\Translate;

/**
 * Class TranslateRepository
 * @package core\repositories
 */
class TranslateRepository
{
    public function getByCode(string $code, string $language): ?Translate
    {
        $this->query()
            ->andWhere(['code' => $code, 'language' => $language])
            ->one();
    }

    public function query(array $select = []): ActiveQuery
    {
        return Translate::find()
            ->select($select);
    }
}