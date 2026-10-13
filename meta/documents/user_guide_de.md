# OSV Menü

Fügt zusätzliche Links ins Ceres-Hauptmenü ein, am Rechner (Aufklappmenü) und am Handy (Menü), ohne neue Kategorien.

## Einrichtung
1. Container-Verknüpfung: **OSV Menü Einträge** → `Ceres::Script.AfterScriptsLoaded`.
2. Konfiguration „Menüeinträge“: Einträge getrennt mit `;`, je Eintrag `Text | Ziel | vor oder nach | Adresse des Nachbarn`.

Beispiel: `Herrnhuter Sterne | /herrnhuter-sterne/ | vor | /weihnachten/weihnachtssterne/`

Weiteres Beispiel, letzter Punkt in der oberen Leiste: `Ersatzteile | /weihnachten/ersatzteile/ | nach | /sale/`

Der neue Eintrag erscheint in derselben Ebene wie der Nachbar, direkt davor oder danach,
im Aufklappmenü oder in der oberen Leiste. Ist das Ziel in dieser Ebene schon verlinkt,
wird nichts doppelt eingefügt; Links in anderen Ebenen zählen nicht.

## Versionen
- 0.2.0: Einträge auch in der oberen Leiste (Rechner); Doppelt-Prüfung nur noch je Ebene.
- 0.1.0: Einträge im Aufklappmenü (Rechner) und in jeder Ebene des Handy-Menüs.

## Hinweise
- Rechner: Das Menü kommt vom Server, das Skript ergänzt es einmal nach dem Start der Ceres-App.
- Handy: Ceres baut das Menü beim Blättern neu, das Skript setzt die Einträge nach jedem Tippen im Menü passend neu.
- Der Link steht nicht im ausgelieferten HTML, Suchmaschinen sehen ihn erst nach Ausführen des Skripts.
- Kein MutationObserver, kein Vue.component, kein Zugriff auf den Ceres-Store.

## Kategorien oben im Menü ausblenden (ab 0.3.0)

Ceres zeigt auf einer Oberkategorie die Kacheln der Unterkategorien nur, wenn die Kategorie in der Linkliste steht (= oben im Menü). Soll eine Kategorie (z. B. Ostern außerhalb der Saison) nicht oben im Menü stehen, ihre Seite aber trotzdem funktionieren:

1. Kategorie in Plenty in der Linkliste lassen (Y).
2. In der Konfiguration „Im Menü ausblenden“ ihre Adresse eintragen, z. B. `/ostern-und-fruehling/` (mehrere mit `;`).
3. Container-Verknüpfung „OSV Menü Ausblenden (Seitenkopf)“ → `Ceres::Template.Style` (einmalig).

Das Ausblenden geschieht per CSS im Seitenkopf: kein Aufblitzen, gleicher Seitencode für Besucher und Suchmaschinen. Footer-Links, Brotkrümel und die Kategorieseite selbst bleiben unberührt.

## Seitenkopf ohne Sprung (ab 0.4.0)

Ceres hält beim Scrollen Teile des Kopfs fest. Dafür schaltet es den Kopf beim ersten Scrollen auf „fest“ um, und genau in diesem Moment verschiebt sich die Seite (Core Web Vitals: CLS). Mit „Seitenkopf ohne Sprung“ (Konfiguration „Seitenkopf“, Standard an) läuft der Kopf am Rechner ab 992 px normal mit, nur die oberste Leiste (erster Baustein im Kopf, sofern nicht „unfixed“) bleibt oben stehen; steht dort keine feste Leiste, läuft der ganze Kopf mit (ab 0.4.1). Im ShopBuilder-Editor ist die Funktion aus. Handy und Tablet unter 992 px bleiben wie von Ceres vorgesehen. Voraussetzung: Datenanbieter „OSV Menü Ausblenden + Kopf (Seitenkopf)“ → `Ceres::Template.Style`.
