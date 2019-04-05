<?php

namespace EthicalJobs\Sanitize\Filters;

/**
 * Removes extra spaces
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */
class RemoveSpaces implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function apply(string $html): string
    {
        $withoutNonBreakingSpaces = str_ireplace('&nbsp;', ' ', $html);

        return preg_replace('/\s+/', ' ', $withoutNonBreakingSpaces);
    }
}
