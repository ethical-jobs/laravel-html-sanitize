<?php

namespace EthicalJobs\Sanitize\Filters;

/**
 * Changes all <H> tags to <h3>
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */
class ConvertHeadings implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function apply(string $html): string
    {
        $leadingReplaced = str_ireplace([
            '<h1',
            '<h2',
            '<h4',
            '<h5',
            '<h6',
        ], '<h3', $html);

        return str_ireplace([
            '</h1>',
            '</h2>',
            '</h4>',
            '</h5>',
            '</h6>',
        ], '</h3>', $leadingReplaced);
    }
}
