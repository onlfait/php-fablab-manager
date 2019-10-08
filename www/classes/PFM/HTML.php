<?php namespace PFM;

abstract class HTML {
  public static function escape(string $string): string {
    return htmlspecialchars($string, ENT_QUOTES);
  }
}
