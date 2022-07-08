<?php
namespace Partner\Brands\Block;

class Brands extends \Magento\Framework\View\Element\Template
{
    public function _prepareLayout()
    {

    }

    /**
     * 查询品牌数据
     */
    public function getBrandsList()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        //获取collection对象
        $collection = $objectManager->get('Partner\Brands\Model\ResourceModel\Brands\Collection');

        return $collection;

    }
}
