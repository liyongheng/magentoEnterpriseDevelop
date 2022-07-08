<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Lyh\Banner\Model\ResourceModel\Order;

use Magento\Framework\Model\ResourceModel\Db\VersionControl\RelationInterface;
use Magento\Sales\Api\OrderItemRepositoryInterface;
use Magento\Sales\Model\ResourceModel\Order\Handler\Address as AddressHandler;
use Magento\Sales\Model\ResourceModel\Order\Payment as OrderPaymentResource;
use Magento\Sales\Model\ResourceModel\Order\Status\History as OrderStatusHistoryResource;

/**
 * Class Relation
 */
class Relation implements RelationInterface
{
    /**
     * @var AddressHandler
     */
    protected $addressHandler;

    /**
     * @var OrderItemRepositoryInterface
     */
    protected $orderItemRepository;

    /**
     * @var OrderPaymentResource
     */
    protected $orderPaymentResource;

    /**
     * @var OrderStatusHistoryResource
     */
    protected $orderStatusHistoryResource;

    /**
     * @param AddressHandler $addressHandler
     * @param OrderItemRepositoryInterface $orderItemRepository
     * @param OrderPaymentResource $orderPaymentResource
     * @param OrderStatusHistoryResource $orderStatusHistoryResource
     */
    public function __construct(
        AddressHandler $addressHandler,
        OrderItemRepositoryInterface $orderItemRepository,
        OrderPaymentResource $orderPaymentResource,
        OrderStatusHistoryResource $orderStatusHistoryResource
    )
    {
        $this->addressHandler = $addressHandler;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderPaymentResource = $orderPaymentResource;
        $this->orderStatusHistoryResource = $orderStatusHistoryResource;
    }

    /**
     * Save relations for Order
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return void
     * @throws \Exception
     */
    public function processRelation(\Magento\Framework\Model\AbstractModel $object)
    {
        /** @var \Magento\Sales\Model\Order $object */
      
        if (null !== $object->getItems()) {
            /** @var \Magento\Sales\Model\Order\Item $item */
            foreach ($object->getItems() as $item) {
                $item->setOrderId($object->getId());
                $item->setOrder($object);
                //我们在这里模拟一个计算运费的值
                $shippingFee = 19.90;
                //注意在这一步调用了itemModel 的setter方法
                $item->setShippingFee($shippingFee);
                //这里保存了item数据
                $this->orderItemRepository->save($item);
            }
        }
        if (null !== $object->getPayment()) {
            $payment = $object->getPayment();
            $payment->setParentId($object->getId());
            $payment->setOrder($object);
            $this->orderPaymentResource->save($payment);
        }
        if (null !== $object->getStatusHistories()) {
            /** @var \Magento\Sales\Model\Order\Status\History $statusHistory */
            foreach ($object->getStatusHistories() as $statusHistory) {
                $statusHistory->setParentId($object->getId());
                $statusHistory->setOrder($object);
                $this->orderStatusHistoryResource->save($statusHistory);
            }
        }
        if (null !== $object->getRelatedObjects()) {
            foreach ($object->getRelatedObjects() as $relatedObject) {
                $relatedObject->setOrder($object);
                $relatedObject->save();
            }
        }
        $this->addressHandler->removeEmptyAddresses($object);
        $this->addressHandler->process($object);
    }
}