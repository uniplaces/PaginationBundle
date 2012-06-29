<?php

/*
 * This file is part of the UniplacesPaginationBundle package.
 *
 * (c) Uniplaces
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Uniplaces\PaginationBundle\Paginator\Pageable;

use Doctrine\ODM\MongoDB\Query\Builder as QueryBuilder;

use Uniplaces\PaginationBundle\Paginator\AbstractPageable;

/**
 * MongoDoctrinePageable.
 *
 * @author Miguel Manso <miguel.manso@uniplaces.com>
 */
class MongoDoctrinePageable extends AbstractPageable
{
    /**
     * Query object
     *
     * @var QueryBuilder
     */
    private $query;

    public function __construct(QueryBuilder $query)
    {
        $this->query = $query;
    }

    public function getItems($offset, $itemCountPerPage)
    {
        return $this->query->skip($offset)->limit($itemCountPerPage)->getQuery()->execute();
    }

    public function count()
    {
        return $this->query->count();
    }
}
