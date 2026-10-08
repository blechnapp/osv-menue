# OSV Menü

Fügt zusätzliche Links ins Ceres-Hauptmenü ein, am Rechner (Aufklappmenü) und am Handy (Menü), ohne neue Kategorien.

## Einrichtung
1. Container-Verknüpfung: **OSV Menü Einträge** → `Ceres::Script.AfterScriptsLoaded`.
2. Konfiguration „Menüeinträge“: Einträge getrennt mit `;`, je Eintrag `Text | Ziel | vor oder nach | Adresse des Nachbarn`.

Beispiel: `Herrnhuter Sterne | /herrnhuter-sterne/ | vor | /weihnachten/weihnachtssterne/`

Der neue Eintrag erscheint in derselben Ebene wie der Nachbar, direkt davor oder danach.
Ist das Ziel dort schon verlinkt, wird nichts doppelt eingefügt.

## Hinweise
- Rechner: Das Menü kommt vom Server, das Skript ergänzt es einmal nach dem Start der Ceres-App.
- Handy: Ceres baut das Menü beim Blättern neu, das Skript setzt die Einträge nach jedem Tippen im Menü passend neu.
- Der Link steht nicht im ausgelieferten HTML, Suchmaschinen sehen ihn erst nach Ausführen des Skripts.
- Kein MutationObserver, kein Vue.component, kein Zugriff auf den Ceres-Store.
