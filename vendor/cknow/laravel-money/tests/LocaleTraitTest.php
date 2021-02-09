<?php

namespace Cknow\Money\Tests;

use Cknow\Money\LocaleTrait;
use GrahamCampbell\TestBench\AbstractPackageTestCase;

class LocaleTraitTest extends AbstractPackageTestCase
{
    public function testGetLocale()
    {
        $mock = $this->getMockForTrait(LocaleTrait::class);

        static::assertEquals('en_US', $mock->getLocale());
    }

    public function testSetLocale()
    {
        $mock = $this->getMockForTrait(LocaleTrait::class);

        $mock->setLocale('fr_FR');

        static::assertEquals('fr_FR', $mock->getLocale());
    }
}
