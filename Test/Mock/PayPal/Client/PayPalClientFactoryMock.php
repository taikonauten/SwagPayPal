<?php declare(strict_types=1);
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SwagPayPal\Test\Mock\PayPal\Client;

use Shopware\Core\Framework\Context;
use SwagPayPal\PayPal\Client\PayPalClient;
use SwagPayPal\PayPal\Client\PayPalClientFactory;
use SwagPayPal\Setting\SwagPayPalSettingGeneralEntity;
use SwagPayPal\Test\Core\Checkout\Payment\Cart\PaymentHandler\PayPalPaymentTest;
use SwagPayPal\Test\Mock\CacheMock;
use SwagPayPal\Test\Mock\PayPal\Resource\TokenResourceMock;

class PayPalClientFactoryMock extends PayPalClientFactory
{
    public const THROW_EXCEPTION = 'throwException';

    /**
     * @var PayPalClientMock
     */
    private $client;

    public function createPaymentClient(Context $context): PayPalClient
    {
        $settings = new SwagPayPalSettingGeneralEntity();
        $settings->setClientId('testClientId');
        $settings->setClientSecret('testClientSecret');
        $settings->setSandbox(true);

        $cacheId = 'test';
        if ($context->hasExtension(PayPalPaymentTest::PAYPAL_RESOURCE_THROWS_EXCEPTION)) {
            $cacheId = self::THROW_EXCEPTION;
        }

        $this->client = new PayPalClientMock(
            new TokenResourceMock(
                new CacheMock(),
                new TokenClientFactoryMock()
            ),
            $settings,
            $cacheId
        );

        return $this->client;
    }

    public function getClient(): PayPalClientMock
    {
        return $this->client;
    }
}
