<?php
/**
 * Cette classe représente un contact
 */
class Contact {
    private ?int $id;
    private ?string $name;
    private ?string $email;
    private ?string $phone;

    /**
     * Constructeur de la classe Contact, tous les champs sont optionnels
     * @param int|null $id
     * @param string|null $name
     * @param string|null $email
     * @param string|null $phone
     */
    public function __construct(int $id = null, string $name = null, string $email = null, string $phone = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * Méthode permettant de créer un contact, résultat d'un fetch sur une table SQL
     * @param array $array
     * @return Contact
     */
    public static function fromArray(array $array): Contact
    {
        $contact = new Contact();
        $contact->setId($array['id']);
        $contact->setName($array['name']);
        $contact->setEmail($array['email']);
        $contact->setPhone($array['phone']);
        return $contact;
    }
    
    public function getId(): ?int 
    {
        return $this->id;
    }

    public function getName(): ?string 
    {
        return $this->name;
    }

    public function getEmail(): ?string 
    {
        return $this->email;
    }

    public function getPhone(): ?string 
    {
        return $this->phone;
    }

    public function setId(?int $id): void 
    {
        $this->id = $id;
    }

    public function setName(?string $name): void 
    {
        $this->name = $name;
    }

    public function setEmail(?string $email): void 
    {
        $this->email = $email;
    }

    public function setPhone(?string $phone): void 
    {
        $this->phone = $phone;
    }

    /**
     * Méthode magique qui est appelée lorsque vous utilisez votre objet comme s'il était un String
     */
    public function __toString() 
    {
        return $this->id . ", " . $this->name . ", " . $this->email . ", " . $this->phone . "\n";
    }  
}