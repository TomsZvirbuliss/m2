<?php
namespace Magebit\CmsPageAttribute\Block;

class PreFooterText extends \Magento\Cms\Block\Page
{

    const PRE_FOOTER_TEXT = "pre_footer_text";

    /**
     * @return string
     */
    public function getPreFooterText()
    {
        return $this->getPage()->getData(self::PRE_FOOTER_TEXT);
    }

    /**
     * Prepare HTML content
     *
     * @return string
     */
    protected function _toHtml()
    {
        $html = "<div class='page-main'>".$this->getPreFooterText()."</div>";
        return $html;
    }
}
