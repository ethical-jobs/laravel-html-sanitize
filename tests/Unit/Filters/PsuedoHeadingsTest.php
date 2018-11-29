<?php

namespace Tests\Unit\Filters;

use DiDom\Document;
use EthicalJobs\Sanitize\Filters\ConvertPsuedoHeadings;

class PsuedoHeadingsTest extends \Tests\TestCase
{
    /**
     * @test
     */
    public function it_converts_heading_like_structures()
    {
        $filter = new ConvertPsuedoHeadings;

        $this->assertEquals($filter->apply(
            '<br><strong>Heading Text</strong><br>Parageaph text'), 
            '<h3>Heading Text</h3>Parageaph text'
        );

        $this->assertEquals($filter->apply(
            '<p><br/><strong>Heading Text</strong><br>Parageaph text</p>'), 
            '<p><h3>Heading Text</h3>Parageaph text</p>'
        );      
        
        $this->assertEquals($filter->apply(
            '<br> <strong>Heading &amp; Text</strong><br> <p>Parageaph text</p>'), 
            '<h3>Heading &amp; Text</h3> <p>Parageaph text</p>'
        );     
        
        $this->assertEquals($filter->apply(
            '<br /> <br /> <strong>If you have questions about this role</strong>, please email to Phil Petersen (Head of Performance and Outcomes) <a href=\"mailto:phil.petersen@vinnies.org.au\" target=\"_blank\">phil.petersen@vinnies.org.au,</a> quoting Program Policy Officer - Performance &amp; Outcomes / VIN1179.<br /> <br /> <br /> <strong>Applications close at 11:30 pm on 14 October 2018</strong><br />'), 
            '<br /> <br /> <strong>If you have questions about this role</strong>, please email to Phil Petersen (Head of Performance and Outcomes) <a href=\"mailto:phil.petersen@vinnies.org.au\" target=\"_blank\">phil.petersen@vinnies.org.au,</a> quoting Program Policy Officer - Performance &amp; Outcomes / VIN1179.<br /> <br /> <h3>Applications close at 11:30 pm on 14 October 2018</h3>'
        );   
    }
}
