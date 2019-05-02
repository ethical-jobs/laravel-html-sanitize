<?php


namespace Tests\Functional;

use EthicalJobs\Sanitize\PurifierFactory;

trait Purifiable
{
    /**
     * @test
     * @dataProvider data
     * @param $before
     * @param $after
     */
    public function it_correctly_purifies(string $before, string $after): void
    {
        $purifier = PurifierFactory::create();

        $purified = $purifier->purify($before);

        $this->assertEquals($after, $purified);
    }
}