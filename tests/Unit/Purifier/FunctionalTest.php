<?php

namespace Tests\Unit\Purifier;

use EthicalJobs\Sanitize\PurifierFactory;
use Tests\TestCase;

class functionalTest extends TestCase
{
    /**
     * @test
     */
    public function its_output_is_deterministic_and_reproducible()
    {
        $fixture = file_get_contents(__DIR__ . '/../../Fixtures/LifeWithoutBarriers/fixture.2.before.html');

        $purifier = PurifierFactory::create();

        $first = $purifier->purify($fixture);

        $second = $purifier->purify($first);
        $this->assertNotEquals($first, $second);

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
