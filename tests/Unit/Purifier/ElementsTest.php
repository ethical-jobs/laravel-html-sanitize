<?php

namespace Tests\Unit\Purifier;

use DiDom\Document;
use EthicalJobs\Sanitize\PurifierFactory;

class ElementsTest extends \Tests\TestCase
{
    /**
     * @test
     */
    public function it_removes_invalid_elements()
    {
        $html = '
            <h1>Hello Heading</h1>
            <span>Hello span</span>
            <div>Hello div</div>
            <p>Hello paragraph #1 <span>Hello span</span></p>
            <p>Hello paragraph #2</p>
        ';

        $purifier = PurifierFactory::create();

        $output = $purifier->purify($html);

        $this->assertFalse(str_contains($output, [
            '<span>','</span>',
        ]));

        $this->assertTrue(str_contains($output, [
            '<h1>Hello Heading</h1>',
            'Hello span',
            '<div>Hello div</div>',
            '<p>Hello paragraph #1 Hello span</p>',
            '<p>Hello paragraph #2</p>',
        ]));        
    }     

    /**
     * @test
     */
    public function it_only_allows_style_attribute_on_paragraphs()
    {
        $html = '
            <h1 style="text-align: right;">Hello Heading</h1>
            <strong style="text-align: right;">Hello Strong</strong>
            <ul style="text-align: right;">
                <li style="text-align: right;">Hello List</li>
            </ul>
            <a href="" style="text-align: right;">Hello Link</a>
            <img style="text-align: right;" src="google.com" />
            <br style="text-align: right;" />
        ';

        $purifier = PurifierFactory::create();

        $output = $purifier->purify($html);

        $this->assertFalse(str_contains($output, [
            'style="text-align: right;"',
            'style=',
        ]));

        $this->assertTrue(str_contains($output, [
            '<h1>Hello Heading</h1>',
            '<strong>Hello Strong</strong>',
            '<ul>',
            '<li>Hello List</li>',
            '<img src="google.com" />',
            '<br />',
        ]));        
    }       

    /**
     * @test
     */
    public function it_converts_all_heading_tags_to_H3()
    {
        $html = '
            <h1>Heading #1</h1>
            <h1 style="text-align: left;">Heading #1</h1>
            <h2>Heading #2</h2>
            <h3>Heading #3</h3>
            <h3 style="text-align: left;">Heading #3</h3>
            <h4>Heading #4</h4>
            <h5>Heading #5</h5>
            <h6>Heading #6</h6>
        ';

        $purifier = PurifierFactory::create();

        $output = $purifier->purify($html);

        $this->assertFalse(str_contains($output, [
            '<h1>Heading #1</h1>',
            '<h1 style="text-align: left;">Heading #1</h1>',
            '<h2>Heading #2</h2>',
            '<h4>Heading #4</h4>',
            '<h5>Heading #5</h5>',
            '<h6>Heading #6</h6>',
        ]));

        $this->assertTrue(str_contains($output, [
            '<h3>Heading #1</h3>',
            '<h3 style="text-align: left;">Heading #1</h3>',
            '<h3>Heading #2</h3>',
            '<h3>Heading #3</h3>',
            '<h3>Heading #4</h3>',
            '<h3>Heading #5</h3>',
            '<h3>Heading #6</h3>',
        ]));        
    }       

    /**
     * @test
     */
    public function it_removes_double_linebreak_elements()
    {
        $html = '<h1>Hello world</h1>
            <br /><br />
            <p>Hello there wonderful paragraph 1<br><br>Hello there wonderful paragraph 1.1</p>
            <br /> <br />
            <p>Hello there wonderful paragraph 2</p>
            <br />   &nbsp;<br /><br />
            <br><br>
            <p>Hello there wonderful paragraph 3</p>';

        $expected = '<h3>Hello world</h3><p> <br></p> <p>Hello there wonderful paragraph 1<br>Hello there wonderful paragraph 1.1</p><p> <br></p> <p>Hello there wonderful paragraph 2</p><p> <br></p> <p>Hello there wonderful paragraph 3</p>';            

        $purifier = PurifierFactory::create();

        $output = $purifier->purify($html);

        $this->assertEquals($output, $expected);
    }     

    /**
     * @test
     */
    public function it_leaves_single_linebreak_elements()
    {
        $html = '
            <h1>Hello world</h1>
            <br />
            <p>Hello there wonderful world...</p>
            <h1>Hello world</h1>
            <br>
            <p>Hello there wonderful world...</p>            
            <br>
        ';

        $purifier = PurifierFactory::create();

        $output = $purifier->purify($html);

        $this->assertFalse(str_contains($output, [
            '<br />',
        ]));

        $this->assertTrue(str_contains($output, [
            '<h1>Hello world</h1>',
            '<br>',
            '<p>Hello there wonderful world...</p>',
        ]));   
        
        $this->assertEquals(3, substr_count($output, '<br>'));        
    }           
}
