<?php

namespace Tests\Functional;

use EthicalJobs\Sanitize\PurifierFactory;
use Tests\TestCase;

class LifeWithoutBarriersTest extends TestCase
{
    /**
     * @test
     */
    public function it_correctly_purifies_fixture_1()
    {
        $before = file_get_contents(__DIR__ . '/../Fixtures/LifeWithoutBarriers/fixture.1.before.html');

        $after = file_get_contents(__DIR__ . '/../Fixtures/LifeWithoutBarriers/fixture.1.after.html');

        $purifier = PurifierFactory::create();

        $purified = $purifier->purify($before);

        $this->assertEquals($purified, $after);
    }

    /**
     * @test
     */
    public function it_correctly_purifies_fixture_2()
    {
        $before = file_get_contents(__DIR__ . '/../Fixtures/LifeWithoutBarriers/fixture.2.before.html');

        $after = file_get_contents(__DIR__ . '/../Fixtures/LifeWithoutBarriers/fixture.2.after.html');

        $purifier = PurifierFactory::create();

        $purified = $purifier->purify($before);

        $this->assertEquals($purified, $after);
    }

    /**
     * @test
     */
    public function it_correctly_purifies_fixture_3()
    {
        $before = file_get_contents(__DIR__ . '/../Fixtures/LifeWithoutBarriers/fixture.3.before.html');

        $after = file_get_contents(__DIR__ . '/../Fixtures/LifeWithoutBarriers/fixture.3.after.html');

        $purifier = PurifierFactory::create();

        $purified = $purifier->purify($before);

        $this->assertEquals($purified, $after);
    }

    /**
     * @test
     */
    public function it_correctly_purifies_fixture_4()
    {
        $before = file_get_contents(__DIR__ . '/../Fixtures/LifeWithoutBarriers/fixture.4.before.html');

        $after = file_get_contents(__DIR__ . '/../Fixtures/LifeWithoutBarriers/fixture.4.after.html');

        $purifier = PurifierFactory::create();

        $purified = $purifier->purify($before);

        $this->assertEquals($purified, $after);
    }
}
