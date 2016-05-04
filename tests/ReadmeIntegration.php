<?php

namespace byrokrat\banking;

use hanneskod\readmetester\PHPUnit\AssertReadme;

/**
 * @coversNothing
 */
class ReadmeIntegration extends \PHPUnit_Framework_TestCase
{
    public function testReadmeIntegrationTests()
    {
        if (!class_exists(AssertReadme::CLASS)) {
            return $this->markTestSkipped('Readme-tester is not available.');
        }

        (new AssertReadme($this))->assertReadme('README.md');
    }
}
