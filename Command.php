<?php

/**
 * Classe permettant de gérer les commandes saisies par l'utilisateur
 */
class Command {

    private $contactManager;

    /**
     *  Constructeur de la classe. Il permet d'initialiser le manager de Contact
     */
    public function __construct()
    {
        $this->contactManager = new ContactManager;
    }

    /**
     * Commande "list" : affiche la liste des $contacts
     * @return void
     */
    public function list(): void 
    {
        $contacts = $this->contactManager->findAll();
        echo "\nAffichage de la liste\n";
        echo "id, nom, email, telephone\n";
        foreach ($contacts as $contact) {
            echo $contact->__toString();
        }
    }

    /**
     * Commande "detail" : affichage d'un seul contact
     * @return void
     */
    public function detail($id): void 
    {
        $contact = $this->contactManager->findById($id);
        if (!$contact) {
            echo "\nContact non trouvé\n";
            return;
        }
        echo "\nid, nom, email, telephone\n";
        echo $contact->__toString();
    }

    /**
     * Commande "create" : crée un contact
     * @param string @name : le nom du contact
     * @param string @email : l'email du contact
     * @param string @phone : le téléphone du contact
     * @return void
     */
    public function create($name, $email, $phone): void
    {
        $contact = $this->contactManager->create($name, $email, $phone);
        if (!$contact) {
            echo "\nCréation non valide, le contact ou l'email existe déjà\n";
            return;
        }
        echo "\nContact créé : " . $contact->__toString();
    }

    /**
     * Commande "delete" : supprime un contact
     * @param int $id : l'id du contact à supprimer
     * @return void
     */
    public function delete($id): void 
    {
        $contact = $this->contactManager->findById($id);
        if (!$contact) {
            echo "\nContact non trouvé\n";
            return;
        }
        $this->contactManager->delete($id);
        echo "\nContact supprimé\n";
    }

    /**
     * Commande "modify" : modifie un contact
     * @param int $id : l'id du contact à modifier
     * @param string $name : nom du contact à modifier
     * @param string $email : email du contact à modifier
     * @param string $phone : téléphone du contact à modifier
     * @return void
     */
    public function modify($id, $name, $email, $phone): void
    {
        $contact = $this->contactManager->modify($id, $name, $email, $phone);
        if (!$contact) {
            echo "\nModification non valide, l'email existe déjà pour un autre conctact\n";
            return;
        }
        echo "\nContact modifié : " . $contact->__toString();
    }

    /**
     * Commande "help" : affiche les commandes disponibles
     * @return void
     */
    public function help(): void 
    {
        echo "\n";
        echo "list : liste les contacts\n";
        echo "detail [id] : affichage d'un seul contact\n";
        echo "create [nom], [email], [telephone] : crée un contact\n";
        echo "delete [id] : supprime un contact\n";
        echo "modify [id], [nom], [email], [telephone] : modifie un contact\n";
        echo "quit : quitte le programme\n";
        echo "help : affiche cette aide\n";
        echo "\n";
        echo "Attention à la syntaxe des commandes, les espaces, virgules et majuscules sont importantes.\n";
    }
}