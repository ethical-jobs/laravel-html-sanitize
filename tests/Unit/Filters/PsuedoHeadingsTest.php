<?php

namespace Tests\Unit\Filters;

use EthicalJobs\Sanitize\Filters\ConvertPsuedoHeadings;
use Generator;
use Tests\TestCase;

class PsuedoHeadingsTest extends TestCase
{
    /**
     * Data for it_converts_heading_like_structures
     *
     * @return array
     */
    public function generateTestDataForHeadingConversions(): Generator
    {
        yield ['raw' => '<br><strong>Heading Text</strong><br>Paragraph text', 'expected' => '<strong>Heading Text</strong>Paragraph text',];
        yield ['raw' => '<strong><h3>Heading</h3> Text</strong> <br> Paragraph text', 'expected' => '<strong><h3>Heading</h3> Text</strong>Paragraph text',];
        yield ['raw' => '<p><br/><strong>Heading Text</strong><br>Paragraph text</p>', 'expected' => '<p><strong>Heading Text</strong>Paragraph text</p>',];
        yield ['raw' => '<br> <strong>Heading &amp; Text</strong><br> <p>Paragraph text</p>', 'expected' => '<strong>Heading &amp; Text</strong> <p>Paragraph text</p>',];
        yield ['raw' => '<p> <strong>Heading &amp; Text</strong></p>', 'expected' => '<strong>Heading &amp; Text</strong>',];
        yield ['raw' => '<br /> <br /> <strong>If you have questions</strong>, please email Person <a href=\"mailto:person@people.planet\" target=\"_blank\">person@people.planet,</a> quoting People.<br /> <br /> <br /> <strong>Applications close, eventually.</strong><br />', 'expected' => '<br /> <br /> <strong>If you have questions</strong>, please email Person <a href=\"mailto:person@people.planet\" target=\"_blank\">person@people.planet,</a> quoting People.<br /> <br /> <strong>Applications close, eventually.</strong>',];
    }

    /**
     * @dataProvider generateTestDataForHeadingConversions
     * @test
     * @param string $raw
     * @param string $expected
     */
    public function testGenerateTestCasesForHeadingConversion(string $raw, string $expected): void
    {
        $filter = new ConvertPsuedoHeadings();

        $actual = $filter->apply($raw);

        self::assertEquals($expected, $actual);
    }
}
