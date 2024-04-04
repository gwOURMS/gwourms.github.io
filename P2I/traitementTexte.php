<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs requis sont définis et non vides
    if (isset($_POST["nomTexte"]) && !empty($_POST["nomTexte"])) {
        // Récupérer les données du formulaire
        $nomTexte = $_POST["nomTexte"];

        // Traitement des données (par exemple, enregistrement dans la base de données)
        // Inclure le fichier de connexion à la base de données
        include("include/connect.php");
        $bdd = getDb();

        // Préparer la requête d'insertion
        $query = "INSERT INTO texte (Nom) VALUES (:nomListe)";
        $statement = $bdd->prepare($query);

        // Liaison des paramètres de requête
        $statement->bindParam(":nomListe", $nomTexte); // Corrected parameter name

        // Exécuter la requête
        if ($statement->execute()) {
            // Rediriger vers une page de succès ou afficher un message de succès
            header("Location: texte_creee_succes.php");
            exit(); // Arrêter l'exécution du script après la redirection
        } else {
            // En cas d'erreur lors de l'exécution de la requête
            echo "Une erreur s'est produite lors de la création de la liste.";
        }
    } else {
        // Si les champs requis ne sont pas définis ou vides
        echo "Veuillez remplir tous les champs requis.";
    }
} else {
    // Si la page est accédée directement sans soumission de formulaire
    echo "Accès non autorisé.";
}
?>
