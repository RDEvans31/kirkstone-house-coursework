  <?php
    $servername = "sql2.freemysqlhosting.net";
    $username = "sql2279111";
    $password = "lW8!rX5%";
    $dbname = "sql2279111";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();

    }
  ?>
