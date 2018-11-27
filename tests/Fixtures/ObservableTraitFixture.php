<?php

declare(strict_types = 1);

namespace Observer\Tests\Fixtures;

use Observer\Observable;
use Observer\ObservableTrait;

class ObservableTraitFixture implements Observable
{
    use ObservableTrait;
}