<?php

namespace EthicalJobs\Sanitize\Filters;

/**
 * Cleans HTML tags
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */
class ConvertPsuedoHeadings implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function apply(string $html): string
    {
        $html = preg_replace(
            '/(<strong>How to Apply(<br *\/?>)?<\/strong>(<br *\/?>)?)+/si',
            '<h3>How to Apply</h3>',
            $html
        );

        $html = preg_replace(
            '/^(<strong>(.{0,80}?)<\/strong>(?:\s+)?(<br *\/?>)?(?:\s+)?)+/si',
            '<strong>$2</strong>',
            $html
        );

        $html = preg_replace(
            '/(<br *\/?>\s?<strong>(.{0,80}?)(<br *\/?>)*<\/strong>\s??<br *\/?>)+/si',
            '<strong>$2</strong>',
            $html
        );

        $html = preg_replace(
            '/(<strong>)\s*?(<\/strong>)/im',
            ' ',
            $html
        );

        $html = preg_replace(
            '/(<p>(?:\s+)?<strong>(?>(.{0,80}?)<\/strong>)(<br *\/?>)?(?:\s+)?<\/p>)+?/si',
            '<strong>$2</strong>',
            $html
        );

        $html = preg_replace(
            '/((?<=<\/ul>)(?:\s+)?<strong>(.{0,80}?)<\/strong>(<br *\/?>)?(?:\s+)?)+/si',
            '<strong>$2</strong>',
            $html
        );

        return $html;
    }
}
