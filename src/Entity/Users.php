<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users implements UserInterface,\Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return (Rolestring)[] The users roles
     */

     public function getRoles()
     {
         return ['ROLE_ADMIN'];
     }

     /**
      * @return string|null the salt
      */

     public function getSalt()
     {
         return null;
     }

     public function eraseCredentials()
     {

     }

     /**
      * @link https://php.net/manual/en/serializable.serialize.php
      * @return string
      * @since 5.1.0
      */

      public function serialize()
      {
          return serialize([
              $this->id,
              $this->username,
              $this->password
          ]);
      }

      /**
       * @link https://php.net/manual/en/serializable.unserialize.php
       * @param string $serialized <p>
       * @return void
       * @since 5,1,0 
       */

       public function unserialize($serialized)
       {
           list(
            $this->id,
            $this->username,
            $this->password
           ) = unserialize($serialized, ['allowed_classes'=> false]); 
       }
}
