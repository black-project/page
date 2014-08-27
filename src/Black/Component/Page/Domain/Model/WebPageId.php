<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\Page\Domain\Model;

use Black\DDD\DDDinPHP\Domain\Model\ValueObject;

/**
 * Class WebPageId
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class WebPageId implements ValueObject
{
    /**
     * @var
     */
    protected $value;

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