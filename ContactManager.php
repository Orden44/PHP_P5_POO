<?php

/**
 * Cette classe permet des requêtes à la base de données et transforme les résutats en objet
 */
class ContactManager {
    
    private $db;

    /**
     *  Constructeur de la classe. Il permet d'initialiser la proprité $db et d'agir avec la base de données 
     */
    public function __construct()
    {
        // On récupère l'instance de PDO
        $db = new DBConnect;
        $this->db = $db->getPDO();
    }

    /**
     * Méthode permettant de récupérer tous les contacts de la base de données
     * @return array : un tableau d'objets Contact
     */
    public function findAll(): array
    {
        $contactsStatement = $this->db->prepare("SELECT * FROM contact");
        $contactsStatement->execute();
        $contacts = [];
        // Retourne la ligne suivante en tant qu'un tableau indexé par le nom des colonnes
        while ($row = $contactsStatement->fetch(PDO::FETCH_ASSOC)) {
            $contacts[] = Contact::fromArray($row);
        }
        return $contacts;
    }

    /**
     * Méthode permettant de récupérer un contact par son id
     * @param int $id : l'id du contact à récupérer
     * @return Contact|null : le contact correspondant à l'id, ou null si aucun contact n'est trouvé
     */
    public function findById(int $id): ?Contact
    {
        $contactsStatement = $this->db->prepare("SELECT * FROM contact WHERE id = :id");
        $contactsStatement->execute(["id" => $id]);
        $contact = $contactsStatement->fetch(PDO::FETCH_ASSOC);
        if (!$contact) {
            return null;
        }
        $contact = Contact::fromArray($contact);
        return $contact;
    }

    /**
     * Méthode permettant de créer un contact dans la base de données
     * @param string @name : le nom du contact
     * @param string @email : l'email du contact
     * @param string @phone : le téléphone du contact
     * @return Contact : le contact qui vient d'être créé
     */
    public function create(string $name, string $email, string $phone): Contact 
    {
        $contactsStatement = $this->db->prepare("INSERT INTO contact (name, email, phone) VALUES (:name, :email, :phone)");
        $contactsStatement->execute(["name" => $name, "email" => $email, "phone" => $phone]);
        $id = $this->db->lastInsertId();
        return $this->findById($id);
    }

    /**
     * Méthode permettant de supprimer un contact de la base de données
     * @param int $id : l'id du contact à supprimer
     */
    public function delete(int $id)
    {
        $contactsStatement = $this->db->prepare("DELETE FROM contact WHERE `contact`.`id` = :id");
        $contactsStatement->execute(["id" => $id]);
    }

    /**
     * Méthode permettant de modifier un contact de la base de données
     * @param int $id : l'id du contact à modifier
     * @param string $name : nom du contact à modifier
     * @param string $email : email du contact à modifier
     * @param string $phone : téléphone du contact à modifier
     * @return Contact : le contact qui vient d'être modifié
     */
    public function modify(int $id, string $name, string $email, string $phone): Contact 
    {
        $contactsStatement = $this->db->prepare("UPDATE `contact` SET `name` = :name, `email` = :email, `phone` = :phone WHERE `contact`.`id` = :id");
        $contactsStatement->execute(["id" => $id, "name" => $name, "email" => $email, "phone" => $phone]);
        return $this->findById($id);
    }
}