<?php

/*
 * This file is part of the UniplacesPaginationBundle package.
 *
 * (c) Uniplaces
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Uniplaces\PaginationBundle\Paginator;

/**
 * PageableInterface.
 *
 * @author Miguel Manso <miguel.manso@uniplaces.com>
 */
interface PageableInterface
{
    /**
     * Return a traversable object that represents the offset/itemCountPerPage boundaries.
     *
     * @return \Traversable
     */
    public function getItems($offset, $itemCountPerPage);

    /**
     * Return total item count
     *
     * @return integer
     */
    public function count();

    /**
     * Get the route parameter key for the page
     *
     * @return string
     */
    public function getPageRouteParameterKey();

    /**
     * Set the route parameter key for the page
     *
     * @param string $key The route parameter key
     */
    public function setPageRouteParameterKey($key);
}
