<?php

namespace Tests\Unit\Purifier;

use DiDom\Document;
use EthicalJobs\Sanitize\PurifierFactory;

class functionalTest extends \Tests\TestCase
{
    /**
     * @test
     */
    public function its_output_is_deterministic_and_repoducable()
    {
        $fixture = file_get_contents(__DIR__.'/../../Fixtures/LifeWithoutBarriers/fixture.2.before.html');

        $purifier = PurifierFactory::create();

        $passes = collect();

        $first = $purifier->purify($fixture);

        $last = $purifier->purify($first);
        $last = $purifier->purify($fixture);
        $last = $purifier->purify($fixture);
        $last = $purifier->purify($fixture);
        $last = $purifier->purify($fixture);
        $last = $purifier->purify($fixture);
        $last = $purifier->purify($fixture);   
        $last = $purifier->purify($fixture);   
        $last = $purifier->purify($fixture);   
        $last = $purifier->purify($fixture);   

        $this->assertEquals($first, $last);
    }     
}
