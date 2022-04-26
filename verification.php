<?php
session_start([
    'cookie_lifetime' => 24400,
]);
if (isset($_POST['mail']) && isset($_POST['password'])) {

    $db = new Database();
    // $email = $_POST["mail"];
    $mail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $pass = filter_input(INPUT_POST, 'password');
    // $password = $_POST["password"];
    $sql = "SELECT * WHERE email LIKE '$email'";
    $request = $db->prepare($sql);
    $request->execute();
    if ($result->rowCount() > 0) {
        $data = $request->fetchAll(PDO::FETCH_CLASS, 'Client');
    }
} else {
    die('Les champs sont imcomplet');
}



//     if ($mail !== "" && $password !== "") {
//         $requete = "SELECT count(*) FROM com_cli where 
//               nom_utilisateur = '" . $mail . "' and mot_de_passe = '" . $password . "' ";
//         $exec_requete = mysqli_query($db, $requete);
//         $reponse      = mysqli_fetch_array($exec_requete);
//         $count = $reponse['count(*)'];
//         if ($count != 0) // nom d'utilisateur et mot de passe correctes
//         {
//             $_SESSION['mail'] = $mail;
//             header('Location: principale.php');
//         } else {
//             header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
//         }
//     } else {
//         header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
//     }
// } else {
//     header('Location: login.php');
// }
// mysqli_close($db); // fermer la connexion