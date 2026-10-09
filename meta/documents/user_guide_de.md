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
