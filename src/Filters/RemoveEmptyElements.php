<?php

namespace EthicalJobs\Sanitize\Filters;

/**
 * Removes empty elements
 * 
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class RemoveEmptyElements implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function apply(string $html): string
    {
        $needles = [
            '<p>\n</p>',
            '<p></p>',
            '<p> </p>',
            '<li>\n</li>',
            '<li></li>',
            '<em>\n</em>',
            '<em></em>',
            '<em> </em>',
        ];

        return str_ireplace($needles, '', $html);
    }
}
