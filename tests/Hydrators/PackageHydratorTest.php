<?php

declare(strict_types=1);

namespace Hydrators;

use PHPUnit\Framework\TestCase;
use Visa\Packages\Package;
use Visa\Packages\PackageHydrator;

class PackageHydratorTest extends TestCase
{
    public function testSinglePackageHydration()
    {
        $hydrator = new PackageHydrator();

        $packageData = [
            'id' => 'e2d2d46a-ee6e-474a-b77b-5423ca26c443',
            'name' => 'Premium',
            'touchpoints' => 1000
        ];

        $package = new Package();
        $package->setId('e2d2d46a-ee6e-474a-b77b-5423ca26c443');
        $package->setName('Premium');
        $package->setTouchpoints(1000);

        $this->assertEquals($package, $hydrator->hydrateObject($packageData));
    }

    public function testMultiplePackagesHydration()
    {
        $hydrator = new PackageHydrator();

        $packageData = [
            [
                'id' => 'e2d2d46a-ee6e-474a-b77b-5423ca26c443',
                'name' => 'Premium',
                'touchpoints' => 1000
            ]
        ];

        $package = new Package();
        $package->setId('e2d2d46a-ee6e-474a-b77b-5423ca26c443');
        $package->setName('Premium');
        $package->setTouchpoints(1000);

        foreach ($hydrator->hydrateObjectArray($packageData) as $hydratedPackage) {
            $this->assertEquals($package, $hydratedPackage);
        }
    }
}
