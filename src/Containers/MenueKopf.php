<?php

namespace OSVMenue\Containers;

use Plenty\Plugin\ConfigRepository;

/**
 * Seitenkopf-Ausgabe (Container Ceres::Template.Style):
 * 1. Blendet Kategorien im oberen Menü (Rechner und Handy) aus, per CSS – schon beim ersten Bild, kein Aufblitzen.
 * 2. Seitenkopf ohne Sprung (Rechner): Ceres schaltet den Kopf beim ersten Scrollen von „läuft mit“ auf „fest“
 *    um und verschiebt dabei die Seite (Layout-Verschiebung, CLS 0,1–0,3). Ab 992 px setzt das Skript nach dem
 *    Start der Ceres-App die Klasse sticky-top, an der Ceres das Umschalten überspringt; das CSS lässt den Kopf
 *    normal mitlaufen und hält nur die oberste Leiste fest, wie bisher. Handy unverändert.
 * 3. Kasse ohne Sprung: Die Kasse (Conversion Checkout, auch die Anmelde-/Gastseite davor) bindet die Shop-CSS aus
 *    dem HeaderPUB nicht ein, diesen Container aber schon. Ceres baut den Inhalt dort erst im Browser auf, die
 *    Fußzeile springt von ca. 160 auf 690 px (CLS 0,09–0,14). Inhaltsbereich mindestens bildschirmhoch.
 * Gleicher Seitencode für alle Besucher und für Suchmaschinen.
 */
class MenueKopf
{
    public function call(ConfigRepository $config): string
    {
        $aus = '';
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
        if (count($regeln)) {
            $aus = '<style>/* OSV Menü: ausgeblendete Kategorien */' . implode(',', $regeln) . '{display:none !important;}</style>';
        }

        $kopf = '';
        $schalter = (string)$config->get('OSVMenue.kopfOhneSprung', 'true');
        if ($schalter === 'true' || $schalter === '1') {
            $kopf = '<style>/* OSV Menü: Seitenkopf ohne Sprung */@media (min-width:992px){'
                . '#page-header.osv-kopf{position:static !important}'
                . '#page-header.osv-kopf #page-header-parent>.widget:first-child:not(.unfixed){position:fixed !important;top:0 !important;left:0;right:0;z-index:1031 !important}'
                . '}</style>'
                . '<script>/* OSV Menü: Seitenkopf ohne Sprung */(function(){'
                . 'function h(){return document.getElementById("page-header")}'
                . 'function an(){try{var k=h();if(!k||innerWidth<992||k.classList.contains("fixed-top"))return;'
                . 'if(window.App&&App.isShopBuilder)return;'
                . 'if(!k.querySelector("#page-header-parent"))return;'
                // Platzhalter für die feste oberste Leiste am #page-header-parent selbst: so behält dieser Kasten
                // seine Lage, und Google zählt beim Umstellen keine Verschiebung (am #page-header wären es 0,005–0,015)
                . 'var p=k.querySelector("#page-header-parent"),f=k.querySelector("#page-header-parent>.widget:first-child");'
                . 'p.style.paddingTop=(f&&!f.classList.contains("unfixed"))?f.getBoundingClientRect().height+"px":"";'
                . 'k.classList.add("osv-kopf","sticky-top")}catch(e){}}'
                . 'function aus(){try{var k=h();if(k&&k.classList.contains("osv-kopf")){k.classList.remove("osv-kopf","sticky-top");'
                . 'var p=k.querySelector("#page-header-parent");if(p)p.style.paddingTop=""}}catch(e){}}'
                . 'function los(n){var a=window.vueApp;if(!(a&&a._isMounted)&&n<60){setTimeout(function(){los(n+1)},50);return}an();'
                . 'addEventListener("resize",function(){aus();an()})}'
                . 'if(document.readyState==="loading")document.addEventListener("DOMContentLoaded",function(){los(0)});else los(0)'
                . '})();</script>';
        }
        $kasse = '';
        $schalterKasse = (string)$config->get('OSVMenue.kasseOhneSprung', 'true');
        if ($schalterKasse === 'true' || $schalterKasse === '1') {
            $kasse = '<style>/* OSV Menü: Kasse ohne Sprung */body.isCheckout #page-body{min-height:100vh}</style>';
        }
        return $aus . $kopf . $kasse;
    }
}
