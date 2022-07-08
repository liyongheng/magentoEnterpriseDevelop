<?php
namespace Lyh\Banner\Plugin;

use Magento\Checkout\Model\Cart;
use Magento\Wishlist\Model\Item;

class WishlistKeepItem
{
    /**
     * @param \Magento\Wishlist\Model\Item $item
     * @param \Magento\Checkout\Model\Cart $cart
     * @return array
     */
    public function beforeAddToCart(Item $item,Cart $cart)
    {
        return [$cart, false];
    }
}