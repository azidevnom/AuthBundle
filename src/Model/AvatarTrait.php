<?php

namespace MNC\Bundle\AuthBundle\Model;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait AvatarTrait
 * @package MNC\Bundle\AuthBundle\Model
 * @author Matías Navarro Carter <mnavarro@option.cl>
 */
trait AvatarTrait
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $avatar;

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return AvatarTrait
     */
    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }
}