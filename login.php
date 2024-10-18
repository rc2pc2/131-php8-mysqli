<?php 
$answer = null;

if (isset($_POST["email"]) && !empty($_POST["email"])
    && isset($_POST["password"]) && !empty($_POST["password"])){
    
    $email = $_POST["email"];
    $password = $_POST["password"];
        
    // ! definiamo delle costanti di configurazione
    define("DATABASE_ADDRESS", "localhost:3306");
    define("DATABASE_USERNAME", "root");
    define("DATABASE_PASSWORD", "root");
    define("DATABASE_NAME", "uni_db");

    $dbConnection = new mysqli(DATABASE_ADDRESS, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);

    if ($dbConnection && $dbConnection->connect_error){
        echo "Error: connection with database failed: error with code: $dbConnection->connect_errno, with message  $dbConnection->connect_error";
    } 

    // # preparo la query come stringa
    // $sqlQuery = "SELECT * FROM `users` WHERE `users`.`email` = \"$email\" AND `users`.`password` = \"$password\";";

    // prepare and bind
    $stmt = $dbConnection->prepare("SELECT * FROM `users` WHERE `users`.`email` = ? AND `users`.`password` = ?;");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    // % la consegno ad un metodo del mio oggetto mysqli che la esegua come query mysql
    $result =  $stmt->get_result();


    // ! per ogni riga presente nella risposta della query
    foreach ($result as $row) {
        
        // % crea un nuovo elemento nell'array $teachers, che e' $row
        // $teachers[] = $row;
        // $answer = $row['id'];
        $answer = true;
    }
    
    // var_dump($answer);
    // var_dump($teachers);

    //> concludo la connessione con il database
    $dbConnection->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 8 </title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <main class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="fw-bold text-center py-4">
                        New SUPERSAFE Login
                </h1>
            </div>
            <?php if ($answer == true) { ?>
                <div class="col-12">
                    <h2 class="fw-bold text-success">
                        Sei autenticato!
                    </h2>
                </div>
            <?php } else { ?>
                <div class="col-12">
                    <h2 class="fw-bold text-danger">
                        Credenziali errate...
                    </h2>
                </div>
            <?php } ?>
            <div class="col-12">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>
</html>


<?php 


// > Vorrei una query che controlli se esista un utente con quella email e quella password:
// # se esiste => sei loggato
// % se non esiste => non sei autorizzato

?>