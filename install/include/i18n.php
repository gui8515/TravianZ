<?php

if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

function install_get_available_languages() {
    static $cached = null;

    if ($cached !== null) {
        return $cached;
    }

    $langDir = dirname(__DIR__) . '/Lang';
    $available = [];

    if (is_dir($langDir)) {
        foreach (glob($langDir . '/*.php') as $file) {
            $code = basename($file, '.php');
            if ($code === 'index') {
                continue;
            }
            $available[$code] = $file;
        }
    }

    if (!isset($available['en'])) {
        $available['en'] = $langDir . '/en.php';
    }

    ksort($available);
    $cached = $available;

    return $cached;
}

function install_load_translations($langCode) {
    $languages = install_get_available_languages();
    $langCode = strtolower((string) $langCode);

    if (!isset($languages[$langCode])) {
        $langCode = 'en';
    }

    $messages = [];
    if (file_exists($languages[$langCode])) {
        $messages = include $languages[$langCode];
        if (!is_array($messages)) {
            $messages = [];
        }
    }

    if ($langCode !== 'en' && isset($languages['en']) && file_exists($languages['en'])) {
        $fallback = include $languages['en'];
        if (is_array($fallback)) {
            $messages = array_replace($fallback, $messages);
        }
    }

    return [$langCode, $messages];
}

function install_t($key, $default = '') {
    global $installMessages;

    if (isset($installMessages[$key])) {
        return $installMessages[$key];
    }

    return $default !== '' ? $default : $key;
}

function install_h($key, $default = '') {
    return htmlspecialchars(install_t($key, $default), ENT_QUOTES, 'UTF-8');
}

function install_translate_legacy($text) {
    global $installMessages;

    if (!isset($installMessages['legacy_map']) || !is_array($installMessages['legacy_map']) || empty($installMessages['legacy_map'])) {
        return $text;
    }

    return strtr($text, $installMessages['legacy_map']);
}

$requestedLang = '';
if (isset($_GET['l'])) {
    $requestedLang = (string) $_GET['l'];
} elseif (isset($_POST['install_lang'])) {
    $requestedLang = (string) $_POST['install_lang'];
} elseif (isset($_SESSION['install_lang'])) {
    $requestedLang = (string) $_SESSION['install_lang'];
}

list($installLang, $installMessages) = install_load_translations($requestedLang);
$_SESSION['install_lang'] = $installLang;

$installAvailableLanguages = [];
foreach (install_get_available_languages() as $code => $path) {
    $display = strtoupper($code);

    if (file_exists($path)) {
        $labelSource = include $path;
        if (is_array($labelSource) && !empty($labelSource['INSTALL_LANG_NAME'])) {
            $display = $labelSource['INSTALL_LANG_NAME'];
        }
    }

    $installAvailableLanguages[$code] = $display;
}
