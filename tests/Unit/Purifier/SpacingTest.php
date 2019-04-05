<?php

namespace Tests\Unit\Purifier;

use EthicalJobs\Sanitize\PurifierFactory;
use Tests\TestCase;

class SpacingTest extends TestCase
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

        $purifier = PurifierFactory::create();

        $output = $purifier->purify($html);

        $this->assertEquals($output,
            '<p>Successful candidates will be required to clear probity checks including National Criminal History Record Check and Working with Children Check (where relevant to the role).</p> <h3>How to Apply</h3><p>Include your resume and covering letter in one document, click ‘Apply’ and follow the prompts. For any enquiries including persons with disability that require adjustments, contact Kristy Crowe at recruitment@lwb.org.au<br><strong>Applications close at midnight on Tuesday 9th October 2018.</strong></p>');
    }

    /**
     * @test
     */
    public function it_removes_multiple_spaces()
    {
        $html = 'Successful   candidates    will be   required to clear probity checks including  <strong>  Hello </strong>';

        $purifier = PurifierFactory::create();

        $output = $purifier->purify($html);

        $this->assertEquals($output,
            '<p>Successful candidates will be required to clear probity checks including <strong> Hello </strong></p>');
    }
}
