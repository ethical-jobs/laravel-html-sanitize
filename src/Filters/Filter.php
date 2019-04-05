<?php

namespace EthicalJobs\Sanitize\Filters;

/**
 * HTML filter contract
 *
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */
interface Filter
{
    /**
     * Apply filter to raw html string
     *
     * @param string $html
     * @return string
     */
    public function apply(string $html): string;
}
