<?php

namespace SEVEN_TECH\Gateway\Test\Subscription;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Subscription\Subscription;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class SubscriptionTest extends TestCase
{
    
    public Static function subscriptionDataProvider()
    {
        $data = [];
        $provider = (new Spreadsheet((new DataProviders)->subscriptionPath, 'Subscription'))->getData()[0];
        $data['email'] = $provider[0];
        $data['userActivationKey'] = $provider[1];

        return $data;
    }

    public function testSubscribe()
    {
        try {
            $data = $this->subscriptionDataProvider();

            $subscribed = (new Subscription())->subscribe($data['email'], $data['userActivationKey']);
            
            $this->assertTrue($subscribed);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while subscribing: " . $e->getErrorMessage());
        }
    }

    #[Depends('testSubscribe')]
    public function testUnsubscribe(array $data)
    {
        try {
            $unsubscribed = (new Subscription())->unsubscribe($data['email']);

            $this->assertTrue($unsubscribed);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while unsubscribing: " . $e->getErrorMessage());
        }
    }
}
