# Google Search Block v2 für Moodle

## Schritt 1: Git Repo namens googlesearchv2 erstellen

1. Es wurde im Git-Konto angemeldet, und ein Public Git Repo namens googlesearchv2 erstellt, die README.md wurde dabei hinzugefügt.

2. Im Verzeichnis /usr/share/nginx/www/moodle/blocks wurde dieses Repo geklont mit:

sudo git clone https://github.com/AhmedT9/googlesearchv2.git

Im Schritt 2 wird der Push-Prozess beschrieben.

## Schritt 2: Grunddateien erstellen:

1. Alle Grunddateien, die in https://moodledev.io/docs/apis/plugintypes/blocks beschrieben sind, wurden mit dem Befehl touch im /usr/share/nginx/www/moodle/blocks/googlesearchv2 erstellt, so sieht am Ende das Verzeichnislayout für das Plugin aus:
   
blocks/googlesearch/
 |-- db
 |   `-- access.php
 |-- lang
 |   `-- en
 |       `-- block_googlesearch.php
 |-- classes
 |   `-- form
 |       `-- search_form.php
 |        `-- styles.css
 |-- block_googlesearchv2.php
 |-- version.php

2. Dann wurde gepusht mit:

git add .
git commit -m "initial commit"
git push

Benutzername von GitHub wurde dann eingegeben, sowie ein persönliches Zugangstoken.

## Schritt 3: Programmablesearchengine auf https://programmablesearchengine.google.com/ holen, die ID davon speichern.

## Schritt 4: API-Key der Custom Search JSON API holen und speichern -> https://developers.google.com/custom-search/v1/overview.

## Schritt 5: Design und Entwicklung:

Design und Entwicklung: Zuerst wurde die Funktionalität des Blocks entworfen und der benötigte Code entwickelt, einschließlich der Erstellung des Forms wie hier beschrieben: https://moodledev.io/docs/apis/subsystems/form und der Verbindung zur Google Custom Search API.

Beachten Sie, dass alle Dateien Kommentare enthalten, die die Funktionalität im Detail erläutern.

## Schritt 6: Stilisierung:

Anschließend wurden CSS-Stile definiert, um das Aussehen des Forms und der Suchergebnisse anzupassen.

## Schritt 7: Plugin-Registrierung:

Die version.php Datei wurde erstellt, um das Plugin bei Moodle zu registrieren.

## Schritt 8: Berechtigungen definieren:

In access.php wurden die benötigten Berechtigungen für den Block festgelegt.

## Schritt 9: Lokalisierung vorbereiten:

Die Sprachdatei lang/en/block_googlesearchv2.php wurde hinzugefügt, um die Texte des Plugins zu definieren und eine spätere Übersetzung zu ermöglichen.

## Schritt 10: Installation

Das Plugin wurde automatisch installiert, indem ssystemstoumi.engineer aufgerufen wurde.

## Schritt 11: Benutzung und Tests

Um den Google Search v2 zu benutzen und testen:

1. Schalten Sie die Bearbeitung auf der gewünschten Seite ein.

2. Wählen Sie "Block hinzufügen" und fügen Sie den „Google Search v2“-Block hinzu.

3. Der Block erscheint nun auf Ihrer Seite, und Nutzer können Suchanfragen direkt eingeben.

# Dateibeschreibungen:

block_googlesearchv2.php -> Diese Datei definiert die Hauptklasse des Blocks, block_googlesearchv2, die von block_base erbt. Sie ist verantwortlich für die Initialisierung des Blocks, das Setzen des Blocktitels und das Generieren des Inhalts, der in dem Block angezeigt wird. Die Methode get_content() verwendet die Google Custom Search API, um Suchergebnisse für einen vom Benutzer eingegebenen Suchbegriff zu erhalten und diese Ergebnisse in einer formatierten Liste anzuzeigen.

version.php -> In version.php werden die Plugin-Version, die erforderliche Moodle-Version für das Plugin, die Reife und die Release-Bezeichnung definiert. Diese Datei ist notwendig für die Moodle-Plugin-Verwaltung und hilft Moodle zu erkennen, ob das Plugin mit der installierten Moodle-Version kompatibel ist.

access.php -> access.php definiert die Fähigkeiten (Capabilities) des Plugins. Es legt fest, welche Benutzerrollen den Block hinzufügen dürfen und welche Berechtigungen für die Verwaltung des Blocks erforderlich sind. Dies beinhaltet Berechtigungen sowohl für das Hinzufügen des Blocks zu einem Kurs als auch zum eigenen Moodle-Dashboard.

lang/en/block_googlesearchv2.php -> Diese Sprachdatei enthält englische Zeichenketten (Strings) für das Plugin, darunter den Namen des Plugins und die Beschreibungen der Fähigkeiten. Die Verwendung von Sprachdateien ermöglicht die einfache Lokalisierung des Plugins für verschiedene Sprachen. Es wurden u.a. Zeichenketten für die classes/form/search_form.php Datei angepasst.

classes/form/search_form.php -> search_form.php definiert das Suchformular und erbt von moodleform. Sie fügt ein Textfeld für die Suchanfrage und einen Absendebutton hinzu.

styles.css -> Die styles.css Datei enthält Details zu den Stildefinitionen für Eingabefelder, Absende-Buttons sowie die Gestaltung der Suchergebnisse und Links.
