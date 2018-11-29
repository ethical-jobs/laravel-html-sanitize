<?php

namespace EthicalJobs\Sanitize;

use HTMLPurifier_Config;
use EthicalJobs\Sanitize\Filters;

/**
 * Html purifier service
 * 
 * @author Andrew McLagan <andrew@ethicaljobs.com.au>
 */

class HTMLPurifier extends \HTMLPurifier
{
    /**
     * Custom text pre filters
     *
     * @var array
     */
    protected $preFilters = [];

    /**
     * Custom text post filters
     *
     * @var array
     */
    protected $postFilters = [];    

    /**
     * {@inheritdoc}
     */
    public function purify($html, $config = null)
    {
        $html = $this->applyFilters($this->preFilters, $html);

        $html = \HTMLPurifier_Encoder::cleanUTF8($html);
        
        $html = stripcslashes($html);  

        $html = parent::purify($html, $config);

        return $this->applyFilters($this->postFilters, $html);
    }

    /**
     * Set the pre-purify filters
     *
     * @param array $filters
     * @return void
     */
    public function setPreFilters(array $filters) : void
    {
        $this->preFilters = $filters;
    }   

    /**
     * Set the post-purify filters
     *
     * @param array $filters
     * @return void
     */    
    public function setPostFilters(array $filters) : void
    {
        $this->postFilters = $filters;
    }   

    /**
     * Apply custom text filters
     *
     * @param string $html
     * @return string
     */    
    protected function applyFilters(array $filters, string $html): string
    {
        foreach ($filters as $filter) {

            $instance = new $filter;

            $html = $instance->apply($html);
        }

        return $html;
    }
}
