<?php


namespace Tests\Functional;


use EthicalJobs\Sanitize\PurifierFactory;
use Tests\TestCase;

class FixturesTest extends TestCase
{
    /**
     * @return array
     */
    public function data(): iterable
    {
        yield ['BeaumontConsulting'];
        yield ['Employers'];
        yield ['LifeWithoutBarriers'];
        yield ['MissionAustralia'];
        yield ['RedCrossAus'];
        yield ['StVinnies'];
        yield ['TheMorelandEnergyFoundation'];
    }

    /**
     * @test
     * @dataProvider data
     * @param string $group
     */
    public function it_correctly_purifies(string $group): void
    {
        $purifier = PurifierFactory::create();

        foreach ($this->fixtures($group) as $fixtures) {
            $purified = $purifier->purify($fixtures['before']);

            $this->assertEquals($fixtures['after'], $purified, "Fixture Test $group@fixture.{$fixtures['fixture']}");
        }
    }

    /**
     * Loads fixtures for use in data providers.
     *
     * @param string $group
     * @return iterable
     */
    private function fixtures(string $group): iterable
    {
        $path = $this->getPath($group);
        $limit = $this->getFixtureCount($path);

        for ($i = 1; $i <= $limit; $i++) {
            yield [
                'before' => file_get_contents("$path/fixture.${i}.before.html"),
                'after' => file_get_contents("$path/fixture.${i}.after.html"),
                'fixture' => $i,
            ];
        }
    }

    /**
     * @param string $group
     * @return string
     */
    private function getPath(string $group): string
    {
        return __DIR__ . "/../Fixtures/{$group}/";
    }


    /**
     * @param string $path
     * @return int
     */
    private function getFixtureCount(string $path): int
    {
        $count = 0;
        $files = glob($path . "fixture.*.before.html");
        if ($files) {
            $count = count($files);
        }

        return $count;
    }
}