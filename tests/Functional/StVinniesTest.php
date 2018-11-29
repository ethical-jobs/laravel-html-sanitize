<?php

namespace Tests\Functional;

use DiDom\Document;
use EthicalJobs\Sanitize\PurifierFactory;

class StVinniesTest extends \Tests\TestCase
{    
    /**
     * @test
     */
    public function it_correctly_purifies_fixture_1()
    {
        $before = file_get_contents(__DIR__.'/../Fixtures/StVinnies/fixture.1.before.html');

        $after = file_get_contents(__DIR__.'/../Fixtures/StVinnies/fixture.1.after.html');

        $purifier = PurifierFactory::create();

        $purified = $purifier->purify($before);

        $this->assertEquals($purified, $after);
    }   
    
    /**
     * @test
     */
    public function it_correctly_purifies_fixture_2()
    {
        $before = file_get_contents(__DIR__.'/../Fixtures/StVinnies/fixture.2.before.html');

        $after = file_get_contents(__DIR__.'/../Fixtures/StVinnies/fixture.2.after.html');

        $purifier = PurifierFactory::create();

        $purified = $purifier->purify($before);

        $this->assertEquals($purified, $after);
    }     
}
