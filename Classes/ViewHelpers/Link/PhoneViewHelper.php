<?php

namespace BERGWERK\BwrkAddress\ViewHelpers\Link;

use BERGWERK\BwrkAddress\ViewHelpers\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * Class PhoneViewHelper
 * @package BERGWERK\BwrkAddress\ViewHelpers\Link
 */
class PhoneViewHelper extends AbstractTagBasedViewHelper
{
    /**
     * @var string
     */
    protected $tagName = 'a';

    /**
     * Initialize arguments
     *
     * @return void
     * @api
     */
    public function initializeArguments()
    {
        $this->registerUniversalTagAttributes();
    }

    /**
     * @param string $tel
     * @return string
     */
    public function render($tel)
    {
        $linkName = $this->renderChildren();

        if (empty($linkName))
        {
            $linkName = $tel;
        }

        $replacements = array(
            '/' => '',
            ' ' => '',
            '-' => ''
        );

        $cleanTel = str_replace(array_keys($replacements), array_values($replacements), $tel);

        $this->tag->addAttribute('href', 'tel:' . $cleanTel);
        $this->tag->setContent($linkName);
        $this->tag->forceClosingTag(true);

        return $this->tag->render();
    }
}