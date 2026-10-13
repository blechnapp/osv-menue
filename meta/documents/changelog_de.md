# Changelog OSVMenue

Neueste Version oben. Jede Version ist ein Git-Tag; im Plugin-Set wird der Tag gewählt.

## 0.4.2 (13.10.2026)

- Seitenkopf ohne Sprung erzeugt beim Laden keine eigene Verschiebung mehr. 0.4.1 setzte den Platzhalter für die feste oberste Leiste an den äußeren Kopf; der innere Kopfkasten rückte dadurch rechnerisch um die Leistenhöhe nach unten, sichtbar war das nicht, Chrome zählte es trotzdem (0,005–0,015 je Seite). Der Platzhalter sitzt jetzt am inneren Kopfkasten selbst. Gemessen: Ladeverschiebung gleich wie ohne Plugin, Scrollen 0, Lage aller Teile unverändert

## 0.4.1 (13.10.2026)

- Seitenkopf ohne Sprung wirkt jetzt auch, wenn oben keine feste Leiste steht (z. B. nach Ende des Gewinnspiels): Dann läuft der ganze Kopf mit. 0.4.0 tat in diesem Fall nichts, und der Sprung kam zurück
- Im ShopBuilder-Editor ausgeschaltet, dort bleibt das Ceres-Verhalten
- Fehler im Skript werden abgefangen; fehlt der erwartete Kopfaufbau, bleibt alles wie von Ceres vorgesehen

## 0.4.0 (11.10.2026)

- Neu: Seitenkopf am Rechner ohne Sprung beim Scrollen (Konfiguration „Seitenkopf“, Standard an). Ceres schaltet den Kopf beim ersten Scrollen von „läuft mit“ auf „fest“ um und verschiebt dabei die Seite; Chrome zählt das als Layout-Verschiebung (gemessen CLS 0,11–0,32 je Seite und Breite, Search Console Computer: alle URLs „zu optimieren“). Ab 992 px läuft der Kopf jetzt normal mit, nur die oberste Leiste bleibt stehen wie bisher. Gemessen danach: Scroll-Verschiebung 0 bis 0,017, Aussehen unverändert, Handy unverändert
- Läuft über den bestehenden Datenanbieter im Container „Ceres::Template.Style“, keine neue Verknüpfung nötig

## 0.3.1 (11.10.2026)

- Doppelt-Prüfung erkennt einen Eintrag jetzt auch am Text, nicht nur an der Adresse. Liefert der Shop einen Punkt selbst aus (z. B. „Ersatzteile“ über eine eigene Kategorie mit anderer Adresse), setzt das Skript ihn nicht ein zweites Mal ein. Gilt jetzt auch für das Handy-Menü

## 0.3.0 (11.10.2026)

- Neu: Kategorien im oberen Menü ausblenden (Konfiguration „Im Menü ausblenden“), per CSS im Seitenkopf, damit nichts aufblitzt. Gedacht für Saison-Kategorien wie Ostern I Frühling: Sie bleiben in der Linkliste (sonst zeigt Ceres auf der Kategorieseite keine Unterkategorie-Kacheln), erscheinen aber nicht oben im Menü
- Neuer Datenanbieter „OSV Menü Ausblenden (Seitenkopf)“ → Container „Ceres::Template.Style“ verknüpfen

## 0.2.0 (09.10.2026)

- Einträge auch in der oberen Menüleiste (Rechner), Doppelt-Prüfung je Ebene

## 0.1.0 (08.10.2026)

- Zusätzliche Einträge im Ceres-Hauptmenü (Rechner und Handy), erster Eintrag Herrnhuter Sterne
