<?php

namespace SEVEN_TECH\Gateway\Test\Subscription;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Subscription\Subscription;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class SubscriptionTest extends TestCase
{
    private String $email = "";

    /**
     * Data provider for SubscriptionTest
     */
    public Static function subscriptionDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->subscriptionPath, 'Subscription'))->getData();
    }

    /** 
     * @test
     * @dataProvider subscriptionDataProvider
     */
    public function testSubscribe($email, $userActivationKey)
    {
        try {
            $this->email = $email;
            $subscribed = (new Subscription())->subscribe($email, $userActivationKey);
            
            $this->assertTrue($subscribed, "Should be subscribed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testUnsubscribe()
    {
        try {

            if (empty($this->email)) {
                $this->fail("Email is not set. Run the subscription test first.");
            }

            $unsubscribed = (new Subscription())->unsubscribe($this->email);

            $this->assertTrue($unsubscribed, "Should be unsubscribed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
