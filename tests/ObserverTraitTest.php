<?php

declare(strict_types = 1);

namespace Observer\Tests;

use Observer\Tests\Fixtures\ObservableTraitFixture;
use Observer\Tests\Fixtures\ObserverFixtureA;
use Observer\Tests\Fixtures\ObserverFixtureB;
use PHPUnit\Framework\TestCase;

class ObserverTraitTest extends TestCase
{
    /**
     * @test
     */
    public function testAddObserver()
    {
        $observableTrait = new ObservableTraitFixture();
        $observableTrait->addObserver(new ObserverFixtureA());

        $this->assertSame($observableTrait->countObservers(), 1);
    }

    /**
     * @test
     */
    public function testDeleteObservers()
    {
        $observableTrait = new ObservableTraitFixture();
        $observableTrait->addObserver(new ObserverFixtureA());

        $this->assertSame($observableTrait->countObservers(), 1);

        $observableTrait->deleteObservers();

        $this->assertSame($observableTrait->countObservers(), 0);
    }

    /**
     * @test
     */
    public function testDeleteObserver()
    {
        $observableTrait = new ObservableTraitFixture();

        $observableTrait->addObserver(new ObserverFixtureA());
        $observableTrait->addObserver(new ObserverFixtureB());

        $this->assertSame($observableTrait->countObservers(), 2);

        $observableTrait->deleteObserver(new ObserverFixtureA());

        $reflection = new \ReflectionClass(new ObservableTraitFixture());

        $property = $reflection->getProperty('observers');
        $property->setAccessible(true);

        $observers = $property->getValue($observableTrait);

        $this->assertSame($observableTrait->countObservers(), 1);
        $this->assertTrue($observers[0] instanceof ObserverFixtureB);
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function testDeleteObserverException()
    {
        $observableTrait = new ObservableTraitFixture();

        $observableTrait->deleteObserver(new ObserverFixtureA());
    }

    /**
     * @test
     */
    public function testNotifyObservers()
    {
        $observableTrait = new ObservableTraitFixture();

        $observerA = $this->getMockBuilder(ObserverFixtureA::class)
            ->setMethods(['update'])
            ->getMock();

        $observerA
            ->expects($this->once())
            ->method('update')
            ->with($observableTrait, []);

        $observerB = new ObserverFixtureB();

        $observableTrait->addObserver($observerA);
        $observableTrait->addObserver($observerB);

        $observableTrait->notifyObservers();
    }
}