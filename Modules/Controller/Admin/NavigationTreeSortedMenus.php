<?php

namespace D3\SortedMenus\Modules\Controller\Admin;

use DOMElement;
use DOMXPath;

class NavigationTreeSortedMenus extends NavigationTreeSortedMenus_parent
{
    /**
     * @param $dom
     */
    public function _addLinks($dom)
    {
        $this->d3SortMenus();

        parent::_addLinks($dom);
    }

    public function d3SortMenus()
    {
        $sorting = [
            // Tabs
            [
                'xpath' => "//OX/*[@id='d3mxd3modules']/*[@id='d3mximporter']/*[@id='d3mxarticleimport']/TAB",
                'order' => ['d3tbclimporter_category', 'd3tbclimporter_selectlist', 'd3tbclimporter_main']
            ],
            // mainmenu
            [
                'xpath' => "//OX/*[@id='d3mxd3modules']/MAINMENU",
                'order' => ['d3konfigurator', 'abcdef', 'd3mxordermanager']
            ],
            // mainmenu with unvalid item
            [
                'xpath' => "//OX/*[@id='d3mxd4modules']/MAINMENU",
                'order' => ['d3konfigurator', 'abcdef', 'd3mxordermanager']
            ],
            // Tabs
            [
                'xpath' => "//OX/*[@id='NAVIGATION_ESHOPADMIN']/*[@id='mxmanageprod']/*[@id='mxcategories']/TAB",
                'order' => ['tbclcategory_pictures']
            ]
            // can't sort buttons
        ];

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

        for ($i = 0; $i < count($allSortedElements); $i++) {
            $keys = array_keys($allSortedElements);
            $elem = $unsortedElements->item($i);
            $searchElem = $elem->parentNode;
            //$searchElem->removeChild($elem);
            $searchElem->appendChild($allSortedElements[$keys[$i]]);
        }
    }
}