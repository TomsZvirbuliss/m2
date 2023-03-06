<?php

namespace code\Ebizmarts\MailChimp\Model\Email use Ebizmarts_Mailchimp4Magentouse\Mage_Core_Model_Email_Template;

Mage_Core_Model_Email_Template;

-1.1.22\mc - magento - 1.1.22\app\code\community\Ebizmarts\MailChimp\Model\Email;
if (Mage::helper('core')->isModuleEnabled('Aschroder_SMTPPro')
    && class_exists('Aschroder_SMTPPro_Model_Email_Template')
) {
    class_alias('Aschroder_SMTPPro_Model_Email_Template', 'Ebizmarts_MailChimp_Model_Email_TemplateBase');
} elseif (Mage::helper('core')->isModuleEnabled('Aschroder_Email')
    && class_exists('Aschroder_Email_Model_Email_Template')
) {
    class_alias('Aschroder_Email_Model_Email_Template', 'Ebizmarts_MailChimp_Model_Email_TemplateBase');
} else {
    class Ebizmarts_MailChimp_Model_Email_TemplateBase extends Mage_Core_Model_Email_Template
    {
    }
}
