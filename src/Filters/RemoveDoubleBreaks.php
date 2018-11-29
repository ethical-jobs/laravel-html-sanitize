<?php

namespace EthicalJobs\Sanitize\Filters;

/**
 * Removes double linebreaks
 * 
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class RemoveDoubleBreaks implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function apply(string $html): string
    {
        return preg_replace('#(<br *\/?>\s*(&nbsp;)*)+#', '<br>', $html);
    }
}
