<?php
/** @noinspection HtmlDeprecatedAttribute CssOverwrittenProperties CssInvalidPropertyValue CssRedundantUnit */

namespace Tests\Unit\Purifier;

use EthicalJobs\Sanitize\PurifierFactory;
use Tests\TestCase;

/**
 * Class StylePropertyTest
 * @package Tests\Unit\Purifier
 */
class StylePropertyTest extends TestCase
{
    /**
     * @test
     */
    public function it_removes_invalid_style_properties(): void
    {
        $html = '
            <p style="text-align: left; font-weight: bold; color: red;">Hello World</p>
            <p style="background-color: transparent; box-sizing: border-box; color: #333333; font-family: Lucida Grande,Verdana,Lucida,Helvetica,Arial,sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; line-height: 18px; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px; padding: 0px; margin: 0px 0px 9px 0px;"><span>f this is the role for you please&nbsp;</span><a href="https://flyingdoctor.applynow.net.au/jobs/RFDS302-mental-health-clinicians" target="_blank" rel="noopener">click here</a>&nbsp;<span></span><span>to make an application. You will be asked to respond to pre-screening questions, attach your CV and you will have the opportunity to attach a cover letter (optional).</span></p>
            <p style="background-color: transparent; box-sizing: border-box; color: #333333; font-family: Lucida Grande,Verdana,Lucida,Helvetica,Arial,sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; line-height: 18px; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px; padding: 0px; margin: 0px 0px 9px 0px;"><span>For further information please contact Jocelyn Middleton, Clinical Team Leader on 0409 154 477.</span></p>
            <p style="background-color: transparent; box-sizing: border-box; color: #333333; font-family: Lucida Grande,Verdana,Lucida,Helvetica,Arial,sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; line-height: 18px; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px; padding: 0px; margin: 0px 0px 9px 0px;"><strong><span>Applications close: COB 26th November 2018.</span></strong></p>
        ';

        $purifier = PurifierFactory::create();

        $output = $purifier->purify($html);

        $this->assertFalse(str_contains($output, [
            'color:',
            'box-sizing:',
            'font-family:',
            'background-color:',
            'background:',
            'font-variant:',
            'letter-spacing:',
            'text-indent:',
            'line-height:',
            'word-spacing:',
            'padding-left:',
        ]));
    }

    /**
     * @test
     */
    public function it_does_not_remove_valid_style_properties(): void
    {
        $html = '
            <p style="text-align: left; font-weight: bold; color: red;">Hello World</p>
            <p style="background-color: transparent; box-sizing: border-box; color: #333333; font-family: Lucida Grande,Verdana,Lucida,Helvetica,Arial,sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; line-height: 18px; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px; padding: 0px; margin: 0px 0px 9px 0px;"><span>f this is the role for you please&nbsp;</span><a href="https://flyingdoctor.applynow.net.au/jobs/RFDS302-mental-health-clinicians" target="_blank" rel="noopener">click here</a>&nbsp;<span></span><span>to make an application. You will be asked to respond to pre-screening questions, attach your CV and you will have the opportunity to attach a cover letter (optional).</span></p>
            <p style="font-style: italic; background-color: transparent; box-sizing: border-box; color: #333333; font-family: Lucida Grande,Verdana,Lucida,Helvetica,Arial,sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; line-height: 18px; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px; padding: 0px; margin: 0px 0px 9px 0px;"><span>For further information please contact Jocelyn Middleton, Clinical Team Leader on 0409 154 477.</span></p>
            <p style="background-color: transparent; text-decoration: uppercase; box-sizing: border-box; color: #333333; font-family: Lucida Grande,Verdana,Lucida,Helvetica,Arial,sans-serif; font-size: 12px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; line-height: 18px; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px; padding: 0px; margin: 0px 0px 9px 0px;"><strong><span>Applications close: COB 26th November 2018.</span></strong></p>
        ';

        $purifier = PurifierFactory::create();

        $output = $purifier->purify($html);

        $settings = config('html-sanitize.htmlpurifier');

        $allowed = explode(',', $settings['CSS.AllowedProperties']);

        $this->assertTrue(str_contains($output, $allowed));
    }

    /**
     * @test
     */
    public function it_removes_justification_styles(): void
    {
        $html = '
            <p style="text-align: justify;">Hello World</p>
            <p style="TEXT-align: JUSTIFY;">Hello World</p>
            <p style="text-align: justify ;">Hello World</p>
            <div style="text-align:JUSTIFY;">Hello World</div>
            <span style="text-align:justify ;">Hello World</span>
            <h1 align="justify">Hello World</h1>
            <p ALIGN="JUSTIFY">Hello World</p>
        ';

        $purifier = PurifierFactory::create();

        $output = $purifier->purify($html);

        $this->assertFalse(str_contains($output, 'justify'));
        $this->assertFalse(str_contains($output, 'JUSTIFY'));
    }
}
