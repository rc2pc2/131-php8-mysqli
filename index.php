<?php 

// // ! qualora la risposta sia ben formata e abbia almeno 1 riga
// if ($result && $result->num_rows > 0){
//     // % chiama la risposta nel db
//     // # ciao risposta, mi dai la prossima riga?
//     // ! e la prossima riga, se esiste viene restituita
//     // ! se non c'e', dammi false
//     while($row = $result->fetch_assoc()){  // * finche' c'e' una riga
//             var_dump($row);
//     }
// }

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
$sqlQuery = "SELECT * FROM `teachers` LIMIT 15";

// % la consegno ad un metodo del mio oggetto mysqli che la esegua come query mysql
$result = $dbConnection->query($sqlQuery);

$teachers = [];

// ! per ogni riga presente nella risposta della query
foreach ($result as $row) {
    // var_dump($row);
    // % crea un nuovo elemento nell'array $teachers, che e' $row
    $teachers[] = $row;
}

// var_dump($teachers);

//> concludo la connessione con il database
$dbConnection->close();

// var_dump($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 8 Mysqli</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <main class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <h1 class="fw-bold text-center p-4">
                    PHP 8 mysqli
                </h1>
            </div>
            <?php foreach ($teachers as $teacher)  { ?>
            <div class="col-4 card" >
                <div class="card-body">
                    <h4 class="card-title">
                        <?php echo $teacher["name"]; ?>
                    </h4>
                    <h5 class="card-subtitle">
                        Email address: <?php echo $teacher["email"]; ?>
                    </h5>
                    <p class="card-text">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quas itaque, repudiandae a consequuntur harum excepturi delectus voluptatibus.
                    </p>
                </div>
            </div>
            <?php } ?>
        </div>
    </main>

</body>
</html>