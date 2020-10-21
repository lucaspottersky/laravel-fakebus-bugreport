<?php

namespace Tests\Unit;

use App\Jobs\FourJob;
use App\Jobs\OneJob;
use App\Jobs\ThreeJob;
use App\Jobs\TwoJob;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // Outputs:
    // testing.DEBUG: OneJob running...
    public function testWontRunAfterTwoJob()
    {
        Bus::fake([TwoJob::class]);

        Bus::chain([
            new OneJob(),
            new TwoJob(),
            new ThreeJob(),
        ])->dispatch();
    }

    // Outputs:
    // testing.DEBUG: OneJob running...
    // testing.DEBUG: TwoJob running...
    public function testWontRunAfterThreeJob()
    {
        Bus::fake([ThreeJob::class]);

        Bus::chain([
            new OneJob(),
            new TwoJob(),
            new ThreeJob(),
            new FourJob(),
        ])->dispatch();
    }
}
