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

use Uniplaces\PaginationBundle\Paginator\AbstractPageable;

/**
 * MongoNativePageable.
 *
 * @author Miguel Manso <miguel.manso@uniplaces.com>
 */
class MongoNativePageable extends AbstractPageable
{
    /**
     * Mongo cursor
     *
     * @var \MongoCursor
     */
    private $query;

    public function __construct(\MongoCursor $query)
    {
        $this->query = $query;
    }

    public function getItems($offset, $itemCountPerPage)
    {
        return $this->query->skip((int) $offset)->limit((int) $itemCountPerPage)->batchSize((int) $itemCountPerPage);
    }

    public function count()
    {
        return $this->query->count();
    }
}
