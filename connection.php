  <?php
    $servername = "sql2.freemysqlhosting.net";
    $username = "sql2273405";
    $password = "gP8!vB2*";
    $dbname = "sql2273405";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();

    }
  ?>
