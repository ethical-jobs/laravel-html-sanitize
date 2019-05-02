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

        $html =  preg_replace('/\s+/', ' ', $withoutNonBreakingSpaces);
        $html =  preg_replace('/>\s+</', '><', $html);
        $html =  preg_replace('/\s*<(\/)?(h3|li|ol|p|ul)>\s*/', "<$1$2>", $html);
        $html =  preg_replace('/\s*<br(?: \/)?>\s*/', "<br>", $html);

        return $html;
    }
}
