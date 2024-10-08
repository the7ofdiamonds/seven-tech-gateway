<?php

namespace SEVEN_TECH\Gateway\Test\Subscription;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Subscription\Subscription;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class SubscriptionTest extends TestCase
{
    /** @test */
    public function testSubscribe($email, $userActivationKey)
    {
        try {
            $subscribed = (new Subscription())->subscribe($email, $userActivationKey);

            $this->assertTrue($subscribed, "Should be subscribed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testUnsubscribe($email)
    {
        try {
            $unsubscribed = (new Subscription())->unsubscribe($email);

            $this->assertTrue($unsubscribed, "Should be unsubscribed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
