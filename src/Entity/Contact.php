<?php 
namespace App\Entity;

use App\Entity\Properties;
use Symfony\Component\Validator\Constraints as Assert;

class Contact {

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     * @var string|null
     */
    private $firstname;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     * @var string|null
     */
    private $lastname;

    /**
     * @Assert\NotBlank()
     * @Assert\Regex(
     *  pattern="/[0-9]{10}/"
     * )
     * @var string|null
     */
    private $phone;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @var string|null
     */
    private $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=10) 
     * @var string|null
     */
    private $message;

    /**
     * @var Properties|null
     */
    private $property;

    

    /**
     * Get the value of firstname
     *
     * @return  string|null
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param  string|null  $firstname
     *
     * @return  Contact
     */ 
    public function setFirstname($firstname): Contact
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return  string|null
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param  string|null  $lastname
     *
     * @return  Contact
     */ 
    public function setLastname($lastname):Contact
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get )
     *
     * @return  string|null
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set )
     *
     * @param  string|null  $phone  )
     *
     * @return  Contact
     */ 
    public function setPhone($phone): Contact
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string|null
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string|null  $email
     *
     * @return  Contact
     */ 
    public function setEmail($email): Contact
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of message
     *
     * @return  string|null
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param  string|null  $message
     *
     * @return  Contact
     */ 
    public function setMessage($message): Contact
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of property
     *
     * @return  Properties|null
     */ 
    public function getProperty(): Properties
    {
        return $this->property;
    }

    /**
     * Set the value of property
     *
     * @param  Properties|null  $property
     *
     * @return  Contact
     */ 
    public function setProperty($property): Contact
    {
        $this->property = $property;

        return $this;
    }
}
