<?php

namespace OSVMenue\Containers;

use Plenty\Plugin\ConfigRepository;

/**
 * Blendet Kategorien im oberen Menü (Rechner und Handy) aus, per CSS im Seitenkopf.
 * Steht im Kopf, damit der Eintrag schon beim ersten Bild unsichtbar ist (kein Aufblitzen).
 * Gleicher Seitencode für alle Besucher und für Suchmaschinen; Footer, Brotkrümel und Kategorieseiten bleiben unberührt.
 */
class MenueKopf
{
    public function call(ConfigRepository $config): string
    {
        $regeln = [];
        foreach (explode(';', (string)$config->get('OSVMenue.ausblenden')) as $adresse) {
            $adresse = trim($adresse);
            // nur einfache Kategorie-Adressen wie /ostern-und-fruehling/ zulassen
            if (!preg_match('#^/[a-z0-9\-]+(/[a-z0-9\-]+)*/$#', $adresse)) {
                continue;
            }
            foreach (['.main-navbar-collapsable', '.mobile-navigation'] as $menue) {
                $regeln[] = $menue . ' .mainmenu > li:has(> a[href="' . $adresse . '"])';
                $regeln[] = $menue . ' .mainmenu > li:has(> a[href$=".de' . $adresse . '"])';
            }
        }
        if (!count($regeln)) {
            return '';
        }
        return '<style>/* OSV Menü: ausgeblendete Kategorien */' . implode(',', $regeln) . '{display:none !important;}</style>';
    }
}
