<?php
/**
 * Acumen for Magento
 * http://gravitydept.com/to/acumen-magento
 *
 * @author	   Brendan Falkowski
 * @package	   gravdept_acumen
 * @copyright  Copyright 2012 Gravity Department http://gravitydept.com
 * @license	   All rights reserved.
 * @version	   1.3.4
 */

/**
 * GravDept changes:
 * ---------------------------
 * function addCartLink() --- added necessary CSS hooks to output
 */

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright   Copyright (c) 2011 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Links block
 *
 * @category    Mage
 * @package     Mage_Checkout
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Checkout_Block_Links extends Mage_Core_Block_Template
{
    /**
     * Add shopping cart link to parent block
     *
     * @return Mage_Checkout_Block_Links
     */
    public function addCartLink()
    {
        $parentBlock = $this->getParentBlock();
        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Mage_Checkout')) {
            $count = $this->getSummaryQty() ? $this->getSummaryQty()
                : $this->helper('checkout/cart')->getSummaryCount();
            
            
            // original
            /*
            if( $count == 1 ) {
                $text = $this->__('My Cart (%s item)', $count);
            } elseif( $count > 0 ) {
                $text = $this->__('My Cart (%s items)', $count);
            } else {
                $text = $this->__('My Cart');
            }
            */
            
            // GravDept, add markup hook for count
            if( $count > 0 ) {
                $text = $this->__('<span class="cart-count">%s</span> ', $count);
            } else {
                $text = $this->__('<span class="cart-count">0</span> ', $count);
            }
            
            // GravDept, append translatable string
            $text .= $this->__('Cart', $count);
            
            $parentBlock->removeLinkByUrl($this->getUrl('checkout/cart'));
            
            // original
            //$parentBlock->addLink($text, 'checkout/cart', $text, true, array(), 50, null, 'class="top-link-cart"');
            
            // GravDept, set position = 1
            $parentBlock->addLink($text, 'checkout/cart', null, true, array(), 1, null, 'class="top-link-cart"');
        }
        return $this;
    }

    /**
     * Add link on checkout page to parent block
     *
     * @return Mage_Checkout_Block_Links
     */
    public function addCheckoutLink()
    {
        if (!$this->helper('checkout')->canOnepageCheckout()) {
            return $this;
        }

        $parentBlock = $this->getParentBlock();
        if ($parentBlock && Mage::helper('core')->isModuleOutputEnabled('Mage_Checkout')) {
            $text = $this->__('Checkout');
            $parentBlock->addLink(
                $text, 'checkout', $text,
                true, array('_secure' => true), 60, null,
                'class="top-link-checkout"'
            );
        }
        return $this;
    }
}
