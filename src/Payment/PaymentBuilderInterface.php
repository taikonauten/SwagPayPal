<?php declare(strict_types=1);
/**
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Swag\PayPal\Payment;

use Shopware\Core\Checkout\Payment\Cart\AsyncPaymentTransactionStruct;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Swag\PayPal\PayPal\Api\Payment;

interface PaymentBuilderInterface
{
    /**
     * The function returns an array with all parameters that are expected by the PayPal API.
     */
    public function getPayment(AsyncPaymentTransactionStruct $paymentTransaction, SalesChannelContext $salesChannelContext): Payment;
}
