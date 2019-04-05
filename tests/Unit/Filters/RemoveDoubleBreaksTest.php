<?php

namespace Tests\Unit\Filters;

use EthicalJobs\Sanitize\Filters\RemoveDoubleBreaks;
use Tests\TestCase;

class RemoveDoubleBreaksTest extends TestCase
{
    /**
     * @test
     */
    public function it_removes_multiple_breaks()
    {
        $html = '<h1>Hello world</h1><br /><br /><p>Hello there wonderful paragraph 1</p> <br /> <br /> <p>Hello there wonderful paragraph 2</p><br />   &nbsp;<br /><br /><br /><br /><br /><br><br><p>Hello there wonderful paragraph 3</p>';

        $filter = new RemoveDoubleBreaks;

        $filtered = $filter->apply($html);

        $this->assertEquals($filtered,
            '<h1>Hello world</h1><br><p>Hello there wonderful paragraph 1</p> <br><p>Hello there wonderful paragraph 2</p><br><p>Hello there wonderful paragraph 3</p>');
    }

    /**
     * @test
     */
    public function it_removes_breaks_of_differing_formats()
    {
        $html = '<h1>Hello world</h1><br /><br><br/><br>Hello<br  /><br><br>There';

        $filter = new RemoveDoubleBreaks;

        $filtered = $filter->apply($html);

        $this->assertEquals($filtered, '<h1>Hello world</h1><br>Hello<br>There');
    }

    /**
     * @test
     */
    public function it_removes_large_amounts_of_breaks()
    {
        $html = '<h1>Hello</h1><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br><br /><br><br/><br>There.';

        $filter = new RemoveDoubleBreaks;

        $filtered = $filter->apply($html);

        $this->assertEquals($filtered, '<h1>Hello</h1><br>There.');
    }

    /**
     * @test
     */
    public function it_can_account_for_new_lines()
    {
        $html = '<h1>Hello</h1>
        <br /><br><br/><br><br />
        <br>
        <br/><br><br />
        Hello
        <br>
        There';

        $expected = '<h1>Hello</h1>
        <br>Hello
        <br>There';

        $filter = new RemoveDoubleBreaks;

        $filtered = $filter->apply($html);

        $this->assertEquals($filtered, $expected);
    }
}
