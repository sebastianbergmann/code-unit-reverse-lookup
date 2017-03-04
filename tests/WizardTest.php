<?php
/*
 * This file is part of code-unit-reverse-lookup.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\CodeUnitReverseLookup;

use PHPUnit\Framework\TestCase;

/**
 * @covers SebastianBergmann\CodeUnitReverseLookup\Wizard
 */
class WizardTest extends TestCase
{
    /**
     * @var Wizard
     */
    private $wizard;

    protected function setUp()
    {
        $this->wizard = new Wizard;
    }

    public function testMethodCanBeLookedUp()
    {
        require __DIR__ . '/_fixture/Foo.php';

        $this->assertEquals(
            'Foo::method',
            $this->wizard->lookup(
                __DIR__ . '/_fixture/Foo.php',
                6
            )
        );

        return $this->wizard;
    }

    /**
     * @depends testMethodCanBeLookedUp
     */
    public function testMethodCanBeLookedUp2(Wizard $wizard)
    {
        require __DIR__ . '/_fixture/Bar.php';

        $this->assertEquals(
            'Bar::method',
            $wizard->lookup(
                __DIR__ . '/_fixture/Bar.php',
                6
            )
        );
    }

    public function testReturnsFilenameAndLineNumberAsStringWhenNotInCodeUnit()
    {
        $this->assertEquals(
            'file.php:1',
            $this->wizard->lookup('file.php', 1)
        );
    }
}
