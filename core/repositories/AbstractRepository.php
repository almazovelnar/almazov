<?php

namespace core\repositories;

/**
 * Class AbstractRepository
 * @package core\repositories
 */
abstract class AbstractRepository
{
    abstract protected function getBy(array $condition);

    public function get(int $id)
    {
        $this->getBy(['id' => $id]);
    }
}