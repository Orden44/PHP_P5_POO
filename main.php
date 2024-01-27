<?php
require_once 'config.php';
require_once 'DBConnect.php';
require_once 'ContactManager.php';
require_once 'Contact.php';
require_once 'Command.php';

/**
 * Cette classe contient l'ensemble des commandes disponibles
 */
$command = new Command();

/**
 * Boucle infinie qui attend une commande de l'utilisateur
 */
while (true) {
    /**
     * A chaque tour de boucle, le programme attend que l'utilisateur tape une commande
     */
    $line = readline("Entrez votre commande (list, detail, create, delete, modify, help, quit): ");
    /**
     * Commande "list" : affiche la liste des $contacts
     */
    if($line == "list") {
        $command->list();
    }
    /**
     * Commande "detail" : affichage d'un seul contact
     */
    elseif (preg_match("/^detail (.*)$/", $line, $matches)) {
        $command->detail($matches[1]);
    }
    /**
     * Commande "create" : crée un contact
     */
    elseif (preg_match("/^create (.*), (.*), (.*)$/", $line, $matches)) {
        $command->create($matches[1], $matches[2], $matches[3]);
    }
    /**
     * Commande "delete" : supprime un contact
     */
    elseif (preg_match("/^delete (.*)$/", $line, $matches)) {
        $command->delete($matches[1]);
    }
    /**
     * Commande "modify" : modifie un contact
     */
    elseif (preg_match("/^modify (.*), (.*), (.*), (.*)$/", $line, $matches)) {
        $command->modify($matches[1], $matches[2], $matches[3], $matches[4]);
    } 
    /**
     * Commande "help" : affiche les commandes disponibles
     */
    elseif ($line == "help") {
        $command->help();
    }
    /**
     * Commande "quit" : on sort de la boucle. Le programme s'arrête
     */
    elseif ($line == "quit") {
        break;
    } 
    /**
     * Commande non valide
     */
    else {
        echo "Commande non valide, vous avez saisi : $line\n";
    }
}
