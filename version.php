<?php
// Sicherstellen, dass dieses Skript nicht direkt aufgerufen wird,
// sondern nur innerhalb des Moodle-Systems ausgeführt wird
defined('MOODLE_INTERNAL') || die();

// Setzen der Komponentenbezeichnung für das Plugin, 
// dies entspricht in der Regel dem Verzeichnisnamen des Plugins in Moodle
$plugin->component = 'block_googlesearchv2';

// Setzen der Versionsnummer des Plugins.
// Moodle verwendet diese Nummer, um zu überprüfen, ob das Plugin aktualisiert werden muss.
// Das Format ist JJJJMMTTRR, wobei JJJJ das Jahr, MM der Monat, TT der Tag und RR die Revisionsnummer ist.
$plugin->version   = 2024021001; // Beispiel: 10. Februar 2024, Revision 1

// Definieren der Moodle-Hauptversion, die mindestens erforderlich ist, damit dieses Plugin funktioniert.
// Dies stellt sicher, dass das Plugin nicht auf einer inkompatiblen Moodle-Version installiert wird.
// Die Zahl entspricht dem Datum der Veröffentlichung der Moodle-Version, hier also Moodle 3.8 (veröffentlicht im November 2019).
$plugin->requires  = 2019111800;

// Setzen der Reifestufe des Plugins. MATURITY_STABLE zeigt an, 
// dass das Plugin als stabil betrachtet wird und für den Produktiveinsatz geeignet ist.
$plugin->maturity  = MATURITY_STABLE;

// Definieren der Veröffentlichungsnummer oder des Namens für diese Version des Plugins.
// Dies kann eine Versionsnummer, ein Datum oder ein beliebiger Name sein, 
// der die Version kennzeichnet und ist hauptsächlich für die Benutzer zur Identifizierung.
$plugin->release   = 'v1.0'; // Version 1.0 des Plugins

