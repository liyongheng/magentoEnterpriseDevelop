<?php

namespace Mypage\OrderHistory\Block\Order;

/**
 * Sales order history block
 *
 * @api
 * @since 100.0.2
 */
class History extends \Magento\Sales\Block\Order\History
{
    //指定模板文件路径
    protected $_template = 'Mypage_OrderHistory::order/history.phtml';

    protected $retCollection = null;

    /**
     * Get orders by increment id or order during
     *
     * @return bool|\Magento\Sales\Model\ResourceModel\Order\Collection
     */
    public function getOrdersByIncrementId($orderCollection)
    {
        if ($orderCollection) {
            // get param
            $request = $this->getRequest();
            $params = $request->getParams();

            $incrementId = $this->getIncrementId($params);
            $orderDuring = $this->getOrderDuring($params);

            // select by orderNo
            if ($incrementId) {
                $this->retCollection = $orderCollection->addFieldToFilter('increment_id',array('like'=>'%'. $incrementId .'%'));
                $this->setData('increment', $incrementId);
            } else if ($orderDuring) {
                // select by order during
                $from = null;
                $now = new \DateTime();
                if ($orderDuring == 1) {
                    // 一个月内
                    $from = date("Y-m-d",strtotime("last month"));
                    
                } else if ($orderDuring == 3) {
                    // 三个月内
                    $from = date("Y-m-d",strtotime("-3 month"));
                } else if ($orderDuring == 6 
                            or $orderDuring == 7) {
                    // 半年内/ 半年前
                    $from = date("Y-m-d",strtotime("-6 month"));
                } else if ($orderDuring == 9) {
                    // すべて
                    $this->setData('orderDuring', $orderDuring);
                    $this->retCollection = $orderCollection;
                    return $this->retCollection;
                }

                if ($orderDuring == 6) {
                    $dateArr = array('lteq'=>$from);
                } else {
                    $dateArr = array('from'=>$from, 'to'=>$now);
                }

                $this->retCollection = $orderCollection->addFieldToFilter('created_at', $dateArr);

                $this->setData('orderDuring', $orderDuring);
            } else {
                $this->retCollection = $orderCollection;
            }
        }
        
        return $this->retCollection;
    }

    /**
     * @inheritDoc
     */
    protected function _prepareLayout()
    {
        $orderCollection = $this->getOrders();
        if ($this->getOrdersByIncrementId($orderCollection)) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'sales.order.history.pager'
            )->setCollection(
                $this->retCollection
            );
            $this->setChild('pager', $pager);
            $this->retCollection->load();
        }
        return $this;
    }

    /**
     * get Order id
     * @param params
     * @return string
     */
    public function getIncrementId($params) {
        return isset($params['increment']) ? $params['increment'] : '';
    }

     /**
     * get Order During
     * @param params
     * @return string
     */
    public function getOrderDuring($params) {
        return isset($params['order_during']) ? $params['order_during'] : '';
    }

    /**
     * Retrieve Currency Switch URL
     *
     * @return string
     */
    public function getHistoryUrl()
    {
        $searchKey = $this->getUrlParam();
        $incrementId = $searchKey['incrementId'];
        return $this->getUrl('sales/order/history', ['incrementId' => $incrementId, 'order_during' => '1']);
    }

}