<?php
function l10nSetLang (string $lang) {
  putenv('LANG=' . $lang);
  setlocale(LC_ALL, $lang);
  stateSet('site.lang', $lang);
}

function l10nBindTextDomain (string $domain, string $directory, string $codeset = 'UTF-8') {
  if (function_exists('bindtextdomain')) {
    // this will make Gettext look for ./core/l10n/<lang>/LC_MESSAGES/main.mo
    bindtextdomain($domain, PFM_ROOT_PATH . $directory);
    // indicates in what encoding the file should be read
    bind_textdomain_codeset($domain, $codeset);
  }
}

// if gettext is not installed
// define some fake functions
if (!function_exists('gettext')) {
  function dgettext (string $domain, string $text) {
    return $text;
  }

  function dngettext (string $domain, string $text1, string $text2, int $n) {
    return $n < 1 ? $text1 : $text2;
  }
}

// return translated text from domain
function text (string $domain, string $text, array $args = null) {
  return vsprintf(dgettext($domain, $text), $args);
}

// return translated plural text from domain
function textPlural (string $domain, string $text1, string $text2, int $n, array $args = null) {
  return vsprintf(dngettext($domain, $text1, $text2, $n), $args);
}

// print translated text from domain
function textPrint (string $domain, string $text, array $args = null) {
  echo(text($domain, $text, $args));
}

// print translated plural text from domain
function textPluralPrint (string $domain, string $text1, string $text2, int $n, array $args = null) {
  echo(textPlural($domain, $text1, $text2, $n, $args));
}
