<?php

declare(strict_types=1);
/**
 * This file is part of the Ray.Query.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace Ray\Query;

use Ray\Query\Annotation\AliasQuery;

class FakeAlias
{
    /**
     * @AliasQuery("todo_item_by_id")
     */
    public function get(string $id)
    {
        return $this;
    }
}
