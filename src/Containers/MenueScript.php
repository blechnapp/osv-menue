<?php

namespace OSVMenue\Containers;

use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Templates\Twig;

class MenueScript
{
    public function call(Twig $twig, ConfigRepository $config): string
    {
        // "Text | Ziel | vor/nach | Nachbar-Adresse; ..." -> Liste fuer das Skript
        $eintraege = [];
        foreach (explode(';', (string)$config->get('OSVMenue.eintraege')) as $zeile) {
            $teile = array_map('trim', explode('|', $zeile));
            if (count($teile) < 4 || $teile[0] === '' || $teile[1] === '' || $teile[3] === '') {
                continue;
            }
            $eintraege[] = [
                't' => $teile[0],
                'u' => $teile[1],
                'w' => strtolower($teile[2]) === 'nach' ? 'nach' : 'vor',
                'n' => $teile[3],
            ];
        }
        if (!count($eintraege)) {
            return '';
        }
        return $twig->render('OSVMenue::Containers.MenueScript', [
            'eintraegeJson' => json_encode($eintraege, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT),
        ]);
    }
}
