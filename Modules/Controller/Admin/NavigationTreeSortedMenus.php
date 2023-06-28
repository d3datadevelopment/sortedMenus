<?php

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

declare(strict_types=1);

namespace D3\SortedMenus\Modules\Controller\Admin;

use DOMElement;
use DOMXPath;
use OxidEsales\Eshop\Core\Registry;

class NavigationTreeSortedMenus extends NavigationTreeSortedMenus_parent
{
    /**
     * @param $dom
     */
    protected function _addLinks($dom)
    {
        $this->d3SortMenus();

        parent::_addLinks($dom);
    }

    public function d3SortMenus()
    {
        $sorting = Registry::getConfig()->getConfigParam('d3MenuSorting');

        if (false === is_array($sorting) || false == count($sorting)) {
            return;
        }

        foreach ($sorting as $sort) {
            $this->d3SortList($this->_oInitialDom, $sort['xpath'], $sort['order']);
        }
    }

    /**
     * @param $dom
     * @param $xPath
     * @param $newOrder
     */
    public function d3SortList($dom, $xPath, $newOrder)
    {
        $xpath = new DOMXPath($dom);
        $unsortedElements = $xpath->query($xPath);

        $remainingUnsortedElements = [];
        $sortedElements = [];

        // split current elements to "contained in sorted" and all others
        foreach ($unsortedElements as $element) {
            if (in_array($element->getAttribute('id'), $newOrder)) {
                $sortedElements[$element->getAttribute('id')] = $element;
            } else {
                $remainingUnsortedElements[$element->getAttribute('id')] = $element;
            }
        }

        // sort elements and filter invalid
        $sortedElements = array_replace(array_flip($newOrder), $sortedElements);
        foreach ($sortedElements as $key => $item) {
            if (!$item instanceof DOMElement) {
                unset($sortedElements[$key]);
            }
        }
        $allSortedElements = array_merge($sortedElements, $remainingUnsortedElements);

        // apply sorted elements
        for ($i = 0; $i < count($allSortedElements); $i++) {
            $keys = array_keys($allSortedElements);
            $elem = $unsortedElements->item($i);
            $searchElem = $elem->parentNode;
            $searchElem->appendChild($allSortedElements[$keys[$i]]);
        }
    }
}