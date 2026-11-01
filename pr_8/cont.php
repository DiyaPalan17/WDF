<html>
    <title>student</title>
    <head>
</head>
<body>
    <?php 
      $dbhost = 'localhost';
      $dbuser = 'root';
      $dbpass = '';
      $dbname = 'student';

      $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

      if($mysqli->connect_errno)
        {
            printf("connect failed: %s<br/>",$mysqli->connect_error);
            exit();
        }
        printf('connected successfully.<br/>');
        ?>
        </body>
        </html>