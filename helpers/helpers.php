<?php
/**
 * Project xml-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/21/2021
 * Time: 01:06
 */
if (!function_exists('xml_convert')) {
    /**
     * Convert Reserved XML characters to Entities
     *
     * @param string
     * @param bool
     *
     * @return    string
     */
    function xml_convert($str, $protect_all = false): string
    {
        $temp = '__TEMP_AMPERSANDS__';

        // Replace entities to temporary markers so that
        // ampersands won't get messed up
        $str = preg_replace('/&#(\d+);/', $temp . '\\1;', $str);

        if ($protect_all === true) {
            $str = preg_replace('/&(\w+);/', $temp . '\\1;', $str);
        }

        $str = str_replace(
            ['&', '<', '>', '"', "'", '-'],
            ['&amp;', '&lt;', '&gt;', '&quot;', '&apos;', '&#45;'],
            $str
        );

        // Decode the temp markers back to entities
        $str = preg_replace('/' . $temp . '(\d+);/', '&#\\1;', $str);

        if ($protect_all === true) {
            return preg_replace('/' . $temp . '(\w+);/', '&\\1;', $str);
        }

        return $str;
    }
}
if (!function_exists('xmlConvert')) {
    /**
     * Convert Reserved XML characters to Entities
     *
     * @param string
     * @param bool
     *
     * @return    string
     */
    function xmlConvert($str, $protect_all = false): string
    {
        return xml_convert($str, $protect_all);
    }
}
if (!function_exists('parse_sitemap')) {
    /**
     * Function parse_sitemap
     *
     * @param string       $domain
     * @param string|array $loc
     * @param string       $lastmod
     * @param string       $type
     * @param string       $newline
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/21/2021 13:07
     */
    function parse_sitemap(string $domain = '', $loc = '', string $lastmod = '', string $type = 'property', string $newline = "\n"): string
    {
        // Since we allow the data to be passes as a string, a simple array
        // or a multidimensional one, we need to do a little prepping.
        if (!is_array($loc)) {
            $loc = [
                [
                    'loc'     => $loc,
                    'lastmod' => $lastmod,
                    'type'    => $type,
                    'newline' => $newline
                ]
            ];
        } elseif (isset($loc['loc'])) {
            // Turn single array into multidimensional
            $loc = [
                $loc
            ];
        }
        $str = '';
        foreach ($loc as $meta) {
            $type    = 'loc';
            $loc     = $meta['loc'] ?? '';
            $lastmod = $meta['lastmod'] ?? '';
            $newline = $meta['newline'] ?? "\n";
            $str     .= "\n<sitemap>\n";
            $str     .= '<' . $type . '>' . trim($domain) . trim($loc) . '.xml' . '</loc>';
            $str     .= "\n<lastmod>" . $lastmod . "</lastmod>";
            $str     .= "\n</sitemap>";
            $str     .= $newline;
        }

        return $str;
    }
}
if (!function_exists('parseSitemap')) {
    /**
     * Function parseSitemap
     *
     * @param string       $domain
     * @param string|array $loc
     * @param string       $lastmod
     * @param string       $type
     * @param string       $newline
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/21/2021 12:52
     */
    function parseSitemap(string $domain = '', $loc = '', string $lastmod = '', string $type = 'property', string $newline = "\n"): string
    {
        return parse_sitemap($domain, $loc, $lastmod, $type, $newline);
    }
}
