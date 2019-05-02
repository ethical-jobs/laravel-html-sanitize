<?php


namespace Tests\Fixtures;


trait LoadsFixtures
{
    /**
     * Loads fixtures for use in data providers.
     *
     * @return iterable
     */
    public function data(): iterable
    {
        $path = $this->getPath();
        $limit = $this->getFixtureCount($path);
        for ($i = 1; $i <= $limit; $i++) {
            yield [
                'before' => file_get_contents("$path/fixture.${i}.before.html"),
                'after' => file_get_contents("$path/fixture.${i}.after.html"),
            ];
        }
    }

    /**
     * @return string
     */
    private function getPath(): string
    {
        $parts = explode('\\', __CLASS__);
        $classname = array_pop($parts);
        $directory = str_replace("Test", '', $classname);

        return __DIR__ . "/../Fixtures/{$directory}/";
    }

    /**
     * @param string $path
     * @return int
     */
    private function getFixtureCount(string $path): int
    {
        $count = 0;
        $files = glob($path . "fixture.*.before.html");
        if ($files){
            $count = count($files);
        }
        return $count;
    }
}