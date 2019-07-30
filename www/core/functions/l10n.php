<?php
function l10nSetLang (string $lang) {
  putenv('LANG=' . $lang);
  setlocale(LC_ALL, $lang);
  stateSet('site.lang', $lang);
}

function l10nBindTextDomain (string $domain, string $directory, string $codeset = 'UTF-8') {
  if (function_exists('bindtextdomain')) {
    bindtextdomain($domain, PFM_ROOT_PATH . $directory);
    bind_textdomain_codeset($domain, $codeset);
  }
}

function l10nSetTextDomain (string $domain = null) {
  if (function_exists('textdomain')) {
    textdomain($domain);
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
function text (string $text, array $args = null, string $domain = null) {
  if (empty($domain)) {
    return vsprintf(gettext($text), $args);
  } else {
    return vsprintf(dgettext($domain, $text), $args);
  }
}

// return translated plural text from domain
function textPlural (string $text1, string $text2, int $n, array $args = null, string $domain = null) {
  if (empty($domain)) {
    return vsprintf(ngettext($text1, $text2, $n), $args);
  } else {
    return vsprintf(dngettext($domain, $text1, $text2, $n), $args);
  }
}

// print translated text from domain
function textPrint (string $text, array $args = null, string $domain = null) {
  echo(text($text, $args, $domain));
}

// print translated plural text from domain
function textPluralPrint (string $text1, string $text2, int $n, array $args = null, string $domain = null) {
  echo(textPlural($text1, $text2, $n, $args, $domain));
}
