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
        return preg_replace(
            '/(<(p|li|em|strong)>)(\s*?)(<\/\2>)/is',
            '$3',
            str_ireplace('\n', ' ', $html)
        );
    }
}
