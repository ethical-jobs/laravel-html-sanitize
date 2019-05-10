<?php

namespace Tests\Unit\Purifier;

use EthicalJobs\Sanitize\PurifierFactory;
use Tests\TestCase;

class FunctionalTest extends TestCase
{
    /**
     * @test
     */
    public function its_output_is_deterministic_and_reproducible()
    {
        $fixture = file_get_contents(__DIR__ . '/../../Fixtures/LifeWithoutBarriers/fixture.2.before.html');

        $purifier = PurifierFactory::create();

        $first = $purifier->purify($fixture);
        $this->assertNotEquals($fixture, $first);

        $second = $purifier->purify($first);
        $this->assertEquals($first, $second);

        $third = $purifier->purify($fixture);
        $this->assertEquals($first, $third);

        $forth = $purifier->purify($fixture);
        $this->assertEquals($first, $forth);

        $fifth = $purifier->purify($fixture);
        $this->assertEquals($first, $fifth);

        $last = $purifier->purify($fixture);
        $this->assertEquals($first, $last);
    }
}
