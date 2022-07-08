<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Lyh\Banner\Model\Order;

use Magento\Framework\Api\AttributeValueFactory;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Sales\Model\AbstractModel;

/**
 * Order Item Model
 *
 * @api
 * @method int getGiftMessageId()
 * @method \Magento\Sales\Model\Order\Item setGiftMessageId(int $value)
 * @method int getGiftMessageAvailable()
 * @method \Magento\Sales\Model\Order\Item setGiftMessageAvailable(int $value)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @since 100.0.2
 */
class Item extends \Magento\Sales\Model\Order\Item
{
    /**
     * 我们在这个文件里只是添加了这一个方法，
     * 将shipping_fee字段表示为model的属性值，
     * 这样通过model保存数据时，会自动将对象的属性值存入db
     */
    public function setShippingFee($shippingFee = 0){
        return $this->setData('shipping_fee', $shippingFee);
    }
}