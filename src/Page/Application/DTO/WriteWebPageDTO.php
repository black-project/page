<?php

namespace Black\Page\Application\DTO;

/**
 * Class WriteWebPage
 */
final class WriteWebPageDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $headline;

    /**
     * @var string
     */
    private $about;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $context;

    /**
     * @var string
     */
    private $type;

    /**
     * @param $id
     * @param null $headline
     * @param null $about
     * @param null $text
     */
    public function __construct($id, $headline, $about, $text)
    {
        $this->id = $id;
        $this->headline = $headline;
        $this->about = $about;
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return json_encode([
                $this->id,
                $this->headline,
                $this->about,
                $this->text,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        return list(
           $this->id,
           $this->headline,
           $this->about,
           $this->text,
        ) = json_decode($serialized);
    }
}
