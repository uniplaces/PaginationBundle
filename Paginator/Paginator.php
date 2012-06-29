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

use Uniplaces\PaginationBundle\Paginator\PageableInterface;

/**
 * Paginator.
 *
 * @author Miguel Manso <miguel.manso@uniplaces.com>
 */
class Paginator
{
    /**
     * The pageable object
     *
     * @var PageableInterface
     */
    private $pageableObject;

    /**
     * Item count per page
     *
     * @var integer
     */
    private $itemCountPerPage;

    /**
     * Curent page number
     *
     * @var integer
     */
    private $currentPageNumber;

    /**
     * Current page items cache
     *
     * @var \Traversable
     */
    private $currentItems;

    /**
     * Constructor
     *
     * @param PageableInterface $pageableObject
     * @param integer $currentPage
     * @param integer $itemCountPerPage
     */
    public function __construct(PageableInterface $pageableObject, $currentPage = 1, $itemCountPerPage = 10)
    {
        $this->pageableObject = $pageableObject;
        $this->setItemCountPerPage($itemCountPerPage);
        $this->setCurrentPageNumber($currentPage);
    }

    /**
     * Returns the number of pages.
     *
     * @return integer
     */
    public function count()
    {
        return ceil($this->pageableObject->count() / $this->getItemCountPerPage());
    }

    public function getPageRouteParameterKey() {
        return $this->pageableObject->getPageRouteParameterKey();
    }

    /**
     * Returns the total number of items available.
     *
     * @return integer
     */
    public function getTotalItemCount()
    {
        return $this->pageableObject->count();
    }

    /**
     * Returns the items for the current page.
     *
     * @return \Traversable
     */
    public function getCurrentItems()
    {
        if ($this->currentItems === null) {
            $this->currentItems = $this->getItemsByPage($this->getCurrentPageNumber());
        }

        return $this->currentItems;
    }

    /**
     * Returns the items for a given page.
     *
     * @return \Traversable
     */
    public function getItemsByPage($pageNumber)
    {
        $pageNumber = $this->normalizePageNumber($pageNumber);

        $offset = ($pageNumber - 1) * $this->getItemCountPerPage();

        return $this->pageableObject->getItems($offset, $this->getItemCountPerPage());
    }

    /**
     * Brings the page number in range of the paginator.
     *
     * @param  integer $pageNumber
     * @return integer
     */
    public function normalizePageNumber($pageNumber)
    {
        $pageNumber = (integer) $pageNumber;

        if ($pageNumber < 1) {
            $pageNumber = 1;
        }

        $pageCount = $this->count();

        if ($pageCount > 0 && $pageNumber > $pageCount) {
            $pageNumber = $pageCount;
        }

        return $pageNumber;
    }

    /**
     * Returns the pages configuration.
     * It returns an array with:
     *  - pageCount
     *  - itemCountPerPage
     *  - first
     *  - last
     *  - current
     *  - previous
     *  - next
     *
     * @return array
     */
    public function getPages()
    {
        $pageCount         = $this->count();
        $currentPageNumber = $this->getCurrentPageNumber();

        $pages = array();
        $pages['pageCount']        = $pageCount;
        $pages['itemCountPerPage'] = $this->getItemCountPerPage();
        $pages['first']            = 1;
        $pages['current']          = $currentPageNumber;
        $pages['last']             = $pageCount;

        // Previous and next
        if ($currentPageNumber - 1 > 0) {
            $pages['previous'] = $currentPageNumber - 1;
        }

        if ($currentPageNumber + 1 <= $pageCount) {
            $pages['next'] = $currentPageNumber + 1;
        }

        return $pages;
    }

    /**
     * Set the per page item count
     *
     * @param integer $itemCountPerPage
     */
    public function setItemCountPerPage($itemCountPerPage)
    {
        $this->itemCountPerPage = (integer)$itemCountPerPage;
    }

    /**
     * Get the per page item count
     *
     * @return integer
     */
    public function getItemCountPerPage()
    {
        return $this->itemCountPerPage;
    }

    /**
     * Sets the current page number.
     *
     * @param  integer $pageNumber Page number
     *
     * @return Paginator $this
     */
    public function setCurrentPageNumber($pageNumber)
    {
        $this->currentPageNumber = (integer)$pageNumber;
        $this->currentItems = null;
        
        return $this;
    }

    /**
     * Returns the current page number.
     *
     * @return integer
     */
    public function getCurrentPageNumber()
    {
        return $this->normalizePageNumber($this->currentPageNumber);
    }
}
