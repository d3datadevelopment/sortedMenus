[![deutsche Version](https://logos.oxidmodule.com/de2_xs.svg)](README.md)
[![english version](https://logos.oxidmodule.com/en2_xs.svg)](README.en.md)

# D³ Sortable Menus für OXID eShop

Das Modul bietet die Möglichkeit, die Adminmenüs in eine gewünschte Reihenfolge zubringen. 

Sortiert werden kann das Seitenmenü auf der linken Seite sowie die Tabs in jedem einzelnen Bereich.

Die Einträge können ausschließlich in der aktuell ausgewählten Ebene verschoben werden.

## Konfiguration

Die Konfiguration erfolgt der Einfachheit halber direkt in der Konfiguration des Shops (`config.inc.php`).

Fügen Sie beispielhaft folgende Konfiguration ein:

```php
$this->d3MenuSorting = [
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
```

Jeder Eintrage definiert mit der xPath-Angabe eine Menüebene, in der sortiert werden kann. Der xPath kann in der jeweiligen menu.xml ermittelt werden.

Im order-Eintrag stehen die IDs der enthaltenen Einträge in der richtigen Reihenfolge. Nicht enthaltene Einträge werden in der bisherigen Sortierung automatisch an das Ende der sortierten Liste angehängt.

Nach dem Ändern der Sortiereinträage muss der tmp-Ordner geleert werden.

## Schnellinstallation

Auf der Konsole im Shoproot (oberhalb von source und vendor) folgenden Befehl ausführen:

```bash
php composer require d3/sortedmenus
``` 

Aktivieren Sie das Modul im Shopadmin unter "Erweiterungen -> Module".

## Changelog

Siehe [CHANGELOG](CHANGELOG.md) für weitere Informationen.

## Lizenz dieser Software (d3/datawizard)
(Stand: 11.12.2021)

```
Copyright (c) D3 Data Development (Inh. Thomas Dartsch)

Diese Software wird unter der GNU GENERAL PUBLIC LICENSE Version 3 vertrieben.
```

Die vollständigen Copyright- und Lizenzinformationen entnehmen Sie bitte der [LICENSE](LICENSE.md)-Datei, die mit diesem Quellcode verteilt wurde.
