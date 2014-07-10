<?php
/**
 * Acumen for Magento
 * http://gravitydept.com/to/acumen-magento
 *
 * @author	   Brendan Falkowski
 * @package	   gravdept_acumen
 * @copyright  Copyright 2013 Gravity Department http://gravitydept.com
 * @license	   All rights reserved.
 * @version	   1.3.5
 */

// GravDept:
// Changed value of $_position
// function _createLabel() --- changed output to remove the wishlist's count


/**
 * Links block
 *
 * @category    Mage
 * @package     Mage_Wishlist
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Wishlist_Block_Links extends Mage_Page_Block_Template_Links_Block
{
    /**
     * Position in link list
     * @var int
     */
    
    /* Magento original */
    /*protected $_position = 30;*/
    
    /* GravDept, custom */
    protected $_position = 3;

    /**
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->helper('wishlist')->isAllow()) {
            $text = $this->_createLabel($this->_getItemCount());
            $this->_label = $text;
            $this->_title = $text;
            $this->_url = $this->getUrl('wishlist');
            return parent::_toHtml();
        }
        return '';
    }

    /**
     * Define label, title and url for wishlist link
     *
     * @deprecated after 1.6.2.0
     */
    public function initLinkProperties()
    {
        $text = $this->_createLabel($this->_getItemCount());
        $this->_label = $text;
        $this->_title = $text;
        $this->_url = $this->getUrl('wishlist');
    }

    /**
     * Count items in wishlist
     *
     * @return int
     */
    protected function _getItemCount()
    {
        return $this->helper('wishlist')->getItemCount();
    }

    /**
     * Create button label based on wishlist item quantity
     *
     * @param int $count
     * @return string
     */
    protected function _createLabel($count)
    {
        /* Magento, original. Hide this. */
        /*
        if ($count > 1) {
            return $this->__('My Wishlist (%d items)', $count);
        } else if ($count == 1) {
            return $this->__('My Wishlist (%d item)', $count);
        } else {
            return $this->__('My Wishlist');
        }
        */
        
        // GravDept, custom
        return $this->__('Wishlist');
    }

    /**
     * @deprecated after 1.4.2.0
     * @see Mage_Wishlist_Block_Links::__construct
     *
     * @return array
     */
    public function addWishlistLink()
    {
        return $this;
    }

    /**
     * Retrieve block cache tags
     *
     * @return array
     */
    public function getCacheTags()
    {
        /** @var $wishlist Mage_Wishlist_Model_Wishlist */
        $wishlist = $this->helper('wishlist')->getWishlist();
        $this->addModelTags($wishlist);
        foreach ($wishlist->getItemCollection() as $item) {
            $this->addModelTags($item);
        }
        return parent::getCacheTags();
    }
}
