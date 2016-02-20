<?php

namespace Black\Page\Application\DTO;

/**
 * Class CreateWebPageDTO
 */
final class CreateWebPageDTO
{
    /**
     * @var
     */
    private $id;

    /**
     * @var
     */
    private $author;

    /**
     * @var
     */
    private $name;

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
     * @param $author
     * @param $name
     */
    public function __construct($id, $author, $name)
    {
        $this->id = $id;
        $this->author = $author;
        $this->name = $name;
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
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return json_encode([
                $this->id,
                $this->author,
                $this->name,
            ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        return list(
            $this->id,
            $this->author,
            $this->name,
            ) = json_decode($serialized);
    }
}
