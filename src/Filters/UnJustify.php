<?php

namespace EthicalJobs\Sanitize\Filters;

/**
 * Removes justification alignment from a document
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */
class UnJustify implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function apply(string $html): string
    {
        $needles = [
            'text-align: justify;',
            'text-align: justify;',
            'text-align: justify ;',
            'text-align:justify ;',
            'text-align:justify;',
            'align="justify"',
        ];

        return str_ireplace($needles, '', $html);
    }
}
