[![deutsche Version](https://logos.oxidmodule.com/de2_xs.svg)](README.md)
[![english version](https://logos.oxidmodule.com/en2_xs.svg)](README.en.md)

# D³ Sortable Menus for OXID eShop

The module offers the possibility to sort the admin menus into a desired order. 

The side menu on the left and the tabs in each individual area can be sorted. 
The action links of the areas are also configured via the menu.xml, but are loaded in the template in a fixed order.

The entries can only be moved in the currently selected level.

## Installation

In the console in the shop root (above source and vendor), execute the following command:

```bash
php composer require d3/sortedmenus
``` 

Activate the module in the admin area of the shop in "Extensions -> Modules".

## Configuration

For the sake of simplicity, the configuration is done directly in the configuration file of the shop (`config.inc.php`).

Insert the following configuration as an example:

```php
$this->d3MenuSorting = [
    // mainmenu
    'move articles and order panels in front'   => [
        'xpath' => "//OX/*[@id='NAVIGATION_ESHOPADMIN']/MAINMENU",
        'order' => ['mxmanageprod', 'mxorders']
    ],
    // submenu
    'move vouchers in shop settings to front'   => [
        'xpath' => "//OX/*[@id='NAVIGATION_ESHOPADMIN']/*[@id='mxshopsett']/SUBMENU",
        'order' => ['mxvouchers']
    ],
    // tabs
    'show category picture tab as first'    => [
        'xpath' => "//OX/*[@id='NAVIGATION_ESHOPADMIN']/*[@id='mxmanageprod']/*[@id='mxcategories']/TAB",
        'order' => ['tbclcategory_pictures']
    ]
];
```

Each entry defines a menu level with the xPath specification in which sorting can take place. The xPath can be determined in the respective menu.xml. Describe the xPath as precisely as possible (ideally using the unique ELement IDs), otherwise the elements to be moved could end up in the wrong area.

In the order entry, the IDs of the contained entries are in the correct order. Entries that are not contained are automatically appended to the end of the sorted list in the previous sort order.

After changing the sorting entries, the tmp folder must be emptied.

## Changelog

See [CHANGELOG](CHANGELOG.md) for further informations.

## Licence of this software (d3/sortedmenus)
(status: 2021-12-11)

```
Copyright (c) D3 Data Development (Inh. Thomas Dartsch)

This software is distributed under the GNU GENERAL PUBLIC LICENSE version 3.
```

For full copyright and licensing information, please see the [LICENSE](LICENSE.md) file distributed with this source code.
