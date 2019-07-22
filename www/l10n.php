<?php
/**
 * This file provide some l10n (localization) helpers
 */

// https://phptherightway.com/
// here we define the global system locale given the found language
putenv('LANG=' . SITE_LANG);

// this might be useful for date functions (LC_TIME)
// or money formatting (LC_MONETARY), for instance
setlocale(LC_ALL, SITE_LANG);

// this will make Gettext look for ./l10n/<lang>/LC_MESSAGES/main.mo
bindtextdomain('main', ROOT_PATH . 'l10n');

// indicates in what encoding the file should be read
bind_textdomain_codeset('main', 'UTF-8');

// here we indicate the default domain the gettext() calls will respond to
textdomain('main');

// if gettext is not installed
if (!function_exists('gettext')) {
  // return (translated) text
  function _($text) {
    return $text;
  }
}

// print translated text
function _e($text) {
  echo(_($text));
}

// return translated plural text
function _n($text) {
  return ngettext($text);
}

// print translated plural text
function _en($text) {
  echo(_n($text));
}
