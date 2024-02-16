<?php
// Sicherstellen, dass das Skript nur innerhalb des Moodle-Systems ausgeführt wird
defined('MOODLE_INTERNAL') || die();

// Definition der Berechtigungen (Capabilities), die das Plugin benötigt
$capabilities = array(
    // Berechtigung für das Hinzufügen einer Instanz des Blocks zu "Meine Startseite"
    'block/googlesearchv2:myaddinstance' => array(
        'captype' => 'write', // Typ der Berechtigung: schreibend
        'contextlevel' => CONTEXT_SYSTEM, // Kontextlevel: Systemweit
        'archetypes' => array(
            'user' => CAP_ALLOW // Standardrolle, der diese Berechtigung erteilt wird: Benutzer
        ),

        // Kopieren der Berechtigungen von einer bestehenden Berechtigung
        'clonepermissionsfrom' => 'moodle/my:addinstance',
    ),

    // Berechtigung für das Hinzufügen einer Instanz des Blocks zu einem Kurs
    'block/googlesearchv2:addinstance' => array(
        'riskbitmask' => RISK_XSS, // Risikokennzeichnung: Möglichkeit von Cross-Site Scripting (XSS)

        'captype' => 'write', // Typ der Berechtigung: schreibend
        'contextlevel' => CONTEXT_BLOCK, // Kontextlevel: Block
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW, // Standardrolle, der diese Berechtigung erteilt wird: Bearbeitende Lehrkraft
            'manager' => CAP_ALLOW // Standardrolle, der diese Berechtigung erteilt wird: Manager
        ),

        // Kopieren der Berechtigungen von einer bestehenden Berechtigung
        'clonepermissionsfrom' => 'moodle/site:manageblocks'
    ),
);

