<?php

namespace Black\Page\Domain\Model;

/**
 * Class WebPageId
 */
final class WebPageId
{
    /**
     * @var
     */
    private $value;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s', $this->getValue());
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param WebPageId $webPageId
     *
     * @return bool
     */
    public function isEqualTo(WebPageId $webPageId)
    {
        return $this->getValue() === $webPageId->getValue();
    }
}
