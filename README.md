# wp-kandidatinnenliste

Wordpress-Plugin zur Verwaltung von Direkt- und Listenkandidatinnen für Bundestagswahlen

## Installation

Den Ordner kandidatinnenliste per FTP ins Unterverzeichnis /wp-content/plugins kopieren und im Backend aktivieren.

Die Datenbank wird dann automatisch angelegt und mit einem Testdatensatz befüllt.

## Benutzung

Im Backend finden sich nach Installation 2 neue Punkte:

### Einstellungen -> Kandidat*liste

Hier finden sich allgemeine Einstellungen zum Plugin.

Der Punkt "Kartenansicht wird um so viele Schritte rausgezoomt (negativ: reingezoomt):" wird benötigt, damit man im Zweifelsfall die komplette Karte sehen kann, da ein Teil von der Sidebar zu Listenplätzen und Kandidatinneninfos überdeckt sein kann.

### Kandidat*liste

Hier findet sich eine Liste der erfassten Kandidatinnen im üblichen Wordpress-Look-and-Feel.

Zu beachten ist:

In den Auswahlfeldern "Wahlkreis" und "Listenplatz" werden die Werte mit einem Sternchen markiert, für die bereits ein Eintrag besteht. Doppelbelegungen werden aber von der Software nicht unterbunden.

Im Feld "Bild" kann durch einen Klick auf "Bild hochladen" auch ein Bild aus der Mediathek eingebunden werden.

Im Feld "Bildlizenz" kann auch html-Code eingegeben werden (z.B. um Links umzusetzen). Aufgrund eines eher seltsamen Bugs, für den ich den Grund noch nicht finden konnte, müssen die aber in der eigentlich fhalcsen Syntax: "&lt;a href=http:&#47;&#47;www&#046;example&#046;com&#47;&gt;Linkziel&lt;&#47;a&gt;" (also OHNE Anführungzeichen um den URL) notiert werden.

### Einbindung

Die Karte kann mit dem Shortcode [kandidatinnenliste_karte] eingebunden werden.

Eine (mit Hilfe von Javascript sortierbare) Tabelle mit allen Kandidatinnen kann mit dem Shortcode [kandidatinnenliste_tabelle] eingebunden werden.

## Bugs

Im Internet Explorer gibt es weder abgerundete Ecken, noch Schatteneffekte bei den über der Karte liegenden Elementen.

Auf Tablets oder sonstigen Geräten mit Touch-Bedienung funktioniert die Karte leider noch nicht so gut.
