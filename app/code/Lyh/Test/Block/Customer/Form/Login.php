<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Lyh\Test\Block\Customer\Form;

/**
 * Customer login form block
 *
 * @api
 * @author      Magento Core Team <core@magentocommerce.com>
 * @since 100.0.2
 */
class Login extends \Magento\Customer\Block\Form\Login
{
    public function getUserName(){
        return '这里从block返回了一个用户名:lyh';
    }

    public function overwriteModel()
    {
        // $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        // $session = $this->_objectManager->get(\Lyh\Test\Model\Customer\Session::class);
        // $entity_id = 1;
        // $customerInfo = $session->getCustomerInfo($entity_id);

        $entity_id = 1;
        $customerInfo = $this->_customerSession->getCustomerInfo($entity_id); //这个属性会自动指向override的model
        //如果这个block里面没有初始化要重写的model,即,$this->_custommerSession,则用上面注释的内容获取Model

        return $customerInfo[0]['email'];
    }
}