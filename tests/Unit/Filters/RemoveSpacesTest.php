<?php

namespace Tests\Unit\Filters;

use DiDom\Document;
use EthicalJobs\Sanitize\Filters\RemoveSpaces;

class SpacingTest extends \Tests\TestCase
{
    /**
     * @test
     */
    public function it_removes_multiple_nbsp()
    {
        $html = 'Successful candidates will be required to clear probity checks including
        National Criminal History Record Check and Working with Children Check (where
        relevant to the role).<br />&nbsp;<strong>&nbsp;&nbsp;</strong>&nbsp;&nbsp;<strong>&nbsp; &nbsp;&nbsp;</strong>&nbsp;<br /><strong>How to Apply</strong><br />Include your resume and covering
        letter in one document, click &lsquo;Apply&rsquo; and follow the prompts. For
        any enquiries including persons with disability that require adjustments,
        contact Kristy Crowe at recruitment@lwb.org.au<br />&nbsp;&nbsp;<br /><strong>Applications close at midnight on Tuesday 9th October 2018.</strong>';

        $filter = new RemoveSpaces;

        $filtered = $filter->apply($html);

        $this->assertEquals($filtered, 'Successful candidates will be required to clear probity checks including National Criminal History Record Check and Working with Children Check (where relevant to the role).<br /> <strong> </strong> <strong> </strong> <br /><strong>How to Apply</strong><br />Include your resume and covering letter in one document, click &lsquo;Apply&rsquo; and follow the prompts. For any enquiries including persons with disability that require adjustments, contact Kristy Crowe at recruitment@lwb.org.au<br /> <br /><strong>Applications close at midnight on Tuesday 9th October 2018.</strong>');
    }       

    /**
     * @test
     */
    public function it_removes_multiple_spaces()
    {
        $html = 'Successful   candidates    will be   required to clear probity checks including  <strong>  Hello </strong>';
  
        $filter = new RemoveSpaces;

        $filtered = $filter->apply($html);

        $this->assertEquals($filtered, 'Successful candidates will be required to clear probity checks including <strong> Hello </strong>');
    }          
}
