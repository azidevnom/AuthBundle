<?php

namespace MNC\Bundle\AuthBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class AbstractUser
 * @package MNC\Bundle\AuthBundle\Model
 * @author Matías Navarro Carter <mnavarro@option.cl>
 * @ORM\MappedSuperclass()
 */
class AbstractUser implements UserInterface
{
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $email;
    /**
     * @var string
     */
    protected $plainPassword;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $password;
    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $salt;
    /**
     * @var array
     * @ORM\Column(type="json_array")
     */
    protected $roles;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return AbstractUser
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return AbstractUser
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     * @return AbstractUser
     */
    public function setPlainPassword(string $plainPassword)
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return AbstractUser
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     * @return AbstractUser
     */
    public function setSalt(string $salt)
    {
        $this->salt = $salt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     * @return AbstractUser
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return in_array($role, $this->roles);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * @return $this
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}