<?php

namespace code\Ebizmarts\MailChimp\Block\Adminhtml\System\Config Mage_Adminhtml_Block_System_Config_Form_Field;

use Ebizmarts_Mailchimp4Magentouse\Mage_Adminhtml_Block_System_Config_Form_Field;
use Varien_Data_Form_Element_Abstract;
use Varien_Date;

-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Block\Adminhtml\System\Config;
/**
 * mc-magento Magento Component
 *
 * @category  Ebizmarts
 * @package   mc-magento
 * @author    Ebizmarts Team <info@ebizmarts.com>
 * @copyright Ebizmarts (http://ebizmarts.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @date:     7/5/16 2:19 PM
 * @file:     Date.php
 */
class Ebizmarts_MailChimp_Block_Adminhtml_System_Config_Date extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $element->setFormat(Varien_Date::DATE_INTERNAL_FORMAT);
        $element->setImage($this->getSkinUrl('images/grid-cal.gif'));
        return parent::render($element);
    }
}
