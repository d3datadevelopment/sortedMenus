[![deutsche Version](https://logos.oxidmodule.com/de2_xs.svg)](README.md)
[![english version](https://logos.oxidmodule.com/en2_xs.svg)](README.en.md)

# D³ Sortierbare Menüs für OXID eShop

Das Modul bietet die Möglichkeit, die Adminmenüs in eine gewünschte Reihenfolge zu bringen. 

Sortiert werden kann das Seitenmenü auf der linken Seite sowie die Tabs in jedem einzelnen Bereich. 
Die Aktionslinks der Bereiche werden zwar ebenfalls über die menu.xml konfiguriert, werden aber im Template in fester Reihenfolge geladen.

Die Einträge können ausschließlich in der aktuell ausgewählten Ebene verschoben werden.

## Installation

Auf der Konsole im Shoproot (oberhalb von source und vendor) folgenden Befehl ausführen:

```bash
php composer require d3/sortedmenus
``` 

Aktivieren Sie das Modul im Shopadmin unter "Erweiterungen -> Module".

## Konfiguration

Die Konfiguration erfolgt der Einfachheit halber direkt in der Konfigurationsdatei des Shops (`config.inc.php`).

Fügen Sie beispielhaft folgende Konfiguration ein:

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

Jeder Eintrage definiert mit der xPath-Angabe eine Menüebene, in der sortiert werden kann. Der xPath kann in der jeweiligen menu.xml ermittelt werden. Beschreiben Sie den xPath möglichst genau (idealerweise anhand der eindeutigen Element-IDs), da sonst die zu verschiebenden Elemente im falschen Bereich landen könnten.

Im order-Eintrag stehen die IDs der enthaltenen Einträge in der richtigen Reihenfolge. Nicht enthaltene Einträge werden in der bisherigen Sortierung automatisch an das Ende der sortierten Liste angehängt.

Nach dem Ändern der Sortiereinträge muss der tmp-Ordner geleert werden.

## Changelog

Siehe [CHANGELOG](CHANGELOG.md) für weitere Informationen.

## Lizenz dieser Software (d3/sortedmenus)
(Stand: 11.12.2021)

```
Copyright (c) D3 Data Development (Inh. Thomas Dartsch)

Diese Software wird unter der GNU GENERAL PUBLIC LICENSE Version 3 vertrieben.
```

Die vollständigen Copyright- und Lizenzinformationen entnehmen Sie bitte der [LICENSE](LICENSE.md)-Datei, die mit diesem Quellcode verteilt wurde.
