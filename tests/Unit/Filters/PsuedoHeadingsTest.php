<?php

namespace Tests\Unit\Filters;

use EthicalJobs\Sanitize\Filters\ConvertPsuedoHeadings;
use Tests\TestCase;

class PsuedoHeadingsTest extends TestCase
{
    /**
     * Data for it_converts_heading_like_structures
     *
     * @return array
     */
    public function data(): array
    {
        return [
            [
                'raw' => '<br><strong>Heading Text</strong><br>Paragraph text',
                'expected' => '<h3>Heading Text</h3>Paragraph text',
            ],
            [
                'raw' => '<strong>Heading Text</strong> <br> Paragraph text',
                'expected' => '<h3>Heading Text</h3>Paragraph text',
            ],
            [
                'raw' => '<p><br/><strong>Heading Text</strong><br>Paragraph text</p>',
                'expected' => '<p><h3>Heading Text</h3>Paragraph text</p>',
            ],
            [
                'raw' => '<br> <strong>Heading &amp; Text</strong><br> <p>Paragraph text</p>',
                'expected' => '<h3>Heading &amp; Text</h3> <p>Paragraph text</p>',
            ],
            [
                'raw' => '<p> <strong>Heading &amp; Text</strong></p>',
                'expected' => '<h3>Heading &amp; Text</h3>',
            ],
            [
                'raw' => '<br /> <br /> <strong>If you have questions about this role</strong>, please email to Phil Petersen (Head of Performance and Outcomes) <a href=\"mailto:phil.petersen@vinnies.org.au\" target=\"_blank\">phil.petersen@vinnies.org.au,</a> quoting Program Policy Officer - Performance &amp; Outcomes / VIN1179.<br /> <br /> <br /> <strong>Applications close at 11:30 pm on 14 October 2018</strong><br />',
                'expected' => '<br /> <br /> <strong>If you have questions about this role</strong>, please email to Phil Petersen (Head of Performance and Outcomes) <a href=\"mailto:phil.petersen@vinnies.org.au\" target=\"_blank\">phil.petersen@vinnies.org.au,</a> quoting Program Policy Officer - Performance &amp; Outcomes / VIN1179.<br /> <br /> <h3>Applications close at 11:30 pm on 14 October 2018</h3>',
            ],
        ];
    }

    /**
     * @dataProvider data
     * @test
     * @param string $raw
     * @param string $expected
     */
    public function it_converts_heading_like_structures(string $raw, string $expected): void
    {
        $filter = new ConvertPsuedoHeadings;

        $this->assertEquals($expected, $filter->apply($raw));
    }
}
