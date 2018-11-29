<?php

namespace Tests\Unit\Filters;

use DiDom\Document;
use EthicalJobs\Sanitize\Filters\RemoveEmptyElements;

class RemoveEmptyElementsTest extends \Tests\TestCase
{
    /**
     * @test
     */
    public function it_removes_empty_paragraphs()
    {
        $html = '<div><p>hello world</p><p>\n</p><p></p><p>Hello</p><p></p></div>';

        $filter = new RemoveEmptyElements;

        $filtered = $filter->apply($html);

        $this->assertEquals($filtered, '<div><p>hello world</p><p>Hello</p></div>');
    }    

    /**
     * @test
     */
    public function it_removes_empty_list_items()
    {
        $html = '<ul><li>hello world</li><li>\n</li><li></li><li>Hello</li></ul>';

        $filter = new RemoveEmptyElements;

        $filtered = $filter->apply($html);

        $this->assertEquals($filtered, '<ul><li>hello world</li><li>Hello</li></ul>');
    }     
    
    /**
     * @test
     */
    public function it_removes_empty_emphisis_items()
    {
        $html = '<div><em>hello world</em><em>\n</em><em></em><em> </em><em>Hello</em></div>';

        $filter = new RemoveEmptyElements;

        $filtered = $filter->apply($html);

        $this->assertEquals($filtered, '<div><em>hello world</em><em>Hello</em></div>');
    }         
}
