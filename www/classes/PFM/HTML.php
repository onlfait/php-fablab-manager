<?php
/**
 * This file is part of the PHP Fablab Manager project.
 *
 * @license MIT
 * @author  Sébastien Mischler <sebastien@onlfait.ch>
 */
namespace PFM;

/**
 * Collection of HTML helpers.
 */
abstract class HTML
{
    /**
     * Convert special characters to HTML entities.
     *
     * @param string $string
     *
     * @return string
     */
    public static function escape(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }
}
