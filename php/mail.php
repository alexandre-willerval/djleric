<?php
  require 'credentials.php';
  $subject = 'Mail de test';
  $message = 'Le message a correctement été envoyé avec la fonction mail() de PHP depuis une VM Flexible Engine '.strftime ('le %d/%m/%y à %T').' ! :-)';
  $headers = 'From: ' . $from . "\r\n" .
    'Reply-To: ' . $from . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
  $parameters = '-r ' . $from;
  $result = mail($to, $subject, $message, $headers, $parameters);
  $info = $result?"message envoyé":"erreur lors de l'envoi du message";
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Test envoi mail en PHP</title>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="container">
      <div class="jumbotron mt-5">
        <h1 class="display-3">fonction mail() de PHP</h1>
        <p class="lead"><?php echo $info; ?></p>
        <hr class="my-5">
        <p class="lead">
          <a class="btn btn-primary btn-lg mb-1" href="../php" role="button">Retour à l'accueil</a>
          <a class="btn btn-primary btn-lg mb-1" href="mail.php" role="button">Envoyer un autre mail</a>
        </p>
      </div>
    </div>
  </body>
</html>