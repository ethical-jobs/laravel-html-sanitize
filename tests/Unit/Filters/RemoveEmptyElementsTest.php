<?php

namespace Tests\Unit\Filters;

use EthicalJobs\Sanitize\Filters\RemoveEmptyElements;
use Tests\TestCase;

class RemoveEmptyElementsTest extends TestCase
{
    /**
     * @test
     */
    public function it_removes_empty_paragraphs(): void
    {
        $html = '<div><p>hello world</p><p>\n</p><p></p><p>Hello</p><p></p></div>';
        $expected = '<div><p>hello world</p> <p>Hello</p></div>';

        $filter = new RemoveEmptyElements;
        $filtered = $filter->apply($html);

        $this->assertEquals($expected, $filtered);
    }

    /**
     * @test
     */
    public function it_removes_empty_list_items(): void
    {
        $html = '<ul><li>hello world</li><li>\n</li><li></li><li>Hello</li></ul>';
        $expected = '<ul><li>hello world</li> <li>Hello</li></ul>';

        $filter = new RemoveEmptyElements;
        $filtered = $filter->apply($html);

        $this->assertEquals($expected, $filtered);
    }

    /**
     * @test
     */
    public function it_removes_empty_emphasis_items(): void
    {
        $html = '<div><em>hello world</em><em>\n</em><em></em><em> </em><em>Hello</em></div>';
        $expected = '<div><em>hello world</em>  <em>Hello</em></div>';

        $filter = new RemoveEmptyElements;
        $filtered = $filter->apply($html);

        $this->assertEquals($expected, $filtered);
    }
}
