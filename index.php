<?php
//La classe du ICS Parser
require 'class.ICS.php';
//Création d'un objet iCAL avec comme parametre l'adresse du fichier ICS
$ical   = new ICal('test.ics');
//Parse chaque "BEGIN:* -> END:*"
$events = $ical->events();
echo "<hr/>";
//Pour chaque "BEGIN:* -> END:*"
foreach ($events as $event) {
    //Affiche le nom du cour
    echo "Nom du cour: ".$event['SUMMARY']."<br/>";
    //Affiche la salle
    echo "Salle: ".$event['LOCATION']."<br/>";
    /*
     * La description contient le groupe
     *                         le nom du prof
     *                         la date d'extraction du ics
     * Il faut maintenant extraire ses informations de la chaine
     */
    $desc = $event['DESCRIPTION'];
    $desc = explode("\\n", $desc);
    /*
     * $desc[1] = groupe
     * $desc[2] = professeur
     */
    //Affiche le nom du prof
    echo "Professeur: ".$desc[2]."<br/>";    
    //Affiche le groupe
    echo "Groupe: ".$desc[1]."<br/>";
    /*
     * Ajuste le timestamp en fonction du fuseau horaire
     * Si date("I", date) retourne 0, c'est GMT+2
     * Si date("I", date) retourne 1, c'est GMT+1
     */
    if(date("I",$ical->iCalDateToUnixTimestamp($event['DTSTART']))){
        //On ajoute 2H au timestamp date debut / date fin
        $dateStartTimestamp=($ical->iCalDateToUnixTimestamp($event['DTSTART']))+7200;
        $dateEndTimestamp=($ical->iCalDateToUnixTimestamp($event['DTEND']))+7200;
    }
    else{
        //On ajoute 1H au timestamp date debut / date fin
        $dateStartTimestamp=($ical->iCalDateToUnixTimestamp($event['DTSTART']))+3600;
        $dateEndTimestamp=($ical->iCalDateToUnixTimestamp($event['DTEND']))+3600; 
    }
    //Converti le timestamp en date
    $dateStart=date("d-m-Y h:i:s", $dateStartTimestamp);
    //Affiche la date de début
    echo "Debut: ".$dateStart."<br/>";
    //Converti le timestamp en date
    $dateEnd=date("d-m-Y h:i:s", $dateEndTimestamp);
    //Affiche la date de fin
    echo "Fin: ".$dateEnd."<br/>";
    echo "<hr/>";
}
?>