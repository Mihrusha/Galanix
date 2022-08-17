<?php

namespace App\Model;

use App\Controller\Database;

class Model
{
    private $uploaded;
    public function __construct()
    {
    }

    public function Upload()
    {
        if (isset($_POST['submit'])) {
            $file = $_FILES['download'];

            $fileName = $_FILES['download']['name'];
            $fileTmpName = $_FILES['download']['tmp_name'];
            $fileSize = $_FILES['download']['size'];
            $fileError = $_FILES['download']['error'];
            $fileType = $_FILES['download']['type'];

            $fileExt = explode('.', $fileName);
            $ActualExt = strtolower((end($fileExt)));

            $allowed = array('csv', 'json', 'xml');

            if (in_array($ActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 10000) {
                        $fileNameNew = $fileName;
                        $fileDestination = 'C:/xampp/htdocs/Galanix/uploads/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        return $fileNameNew;
                        header("Location:/Galanix/index.php?$this->uploaded");
                    } else {
                        echo 'File is too big';
                    }
                } else {
                    echo 'There was an error uploading file';
                }
            } else echo 'You can`t upload files of this type';
        }
    }

    public function Insert($UID, $Name, $Age, $Email, $Phone, $Gender)
    {
        $db = new Database;

        $sql = "INSERT INTO users_1 (UID,Name,Age,Email,Phone,Gender) VALUES ($UID,'$Name','$Age','$Email','$Phone','$Gender')";
        $st = $db->conn->prepare($sql);
        $st->execute();
    }

    public function Update($UID, $Name, $Age, $Email, $Phone, $Gender)
    {
        $db = new Database;
        $sql2 = "UPDATE users_1 SET Name='$Name',Age='$Age',Email='$Email',Phone='$Phone',Gender='$Gender' WHERE UID = $UID";
        $stmt = $db->conn->prepare($sql2);
        $stmt->execute();
    }

    public function SelectID($id)
    {
        $db = new Database;
        $sql = "SELECT * FROM users_1 where UID = $id";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        } else {
            $result = 0;
        }
        return $result;
    }

    public function GetAll()
    {
        $db = new Database;
        $sql = "SELECT * FROM users_1";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll();
        } else {
            $result = 0;
        }
        return $result;
    }

    public function CleanTable()
    {
        $db = new Database;
        $sql = "TRUNCATE `test`.`users_1`";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute();
    }

    public function ReadFile($upload)
    {

        $fileway = 'C:/xampp/htdocs/Galanix/uploads/';
        // C:\xampp\htdocs\Galanix\uploads\users-1.csv
        // $readfile = file_get_contents("C:/xampp/htdocs/Galanix/uploads/" . $upload);
        $csv = array_map('str_getcsv', file($fileway . $upload));
        $csv2 = array_shift($csv);
        foreach ($csv as $col) {
            if (count($col) < 6) {
                echo 'Wrong Data';
                die;
            }

            $result = $this->SelectID($col[0]);
            if ($result != 0) {
                foreach ($result as $row) {

                    $this->Update($col[0], $col[1], $col[2], $col[3], $col[4], $col[5]);
                }
            }

            if ($result == 0) {
                $this->Insert($col[0], $col[1], $col[2], $col[3], $col[4], $col[5]);
            }
        }
    }

    public function Export()
    {
        $db = new Database;

        $csvFile = "export.csv";
        $handle = fopen($csvFile, "w");
        if ($handle === false) {
            exit("Error creating $csvFile");
        }

        $stmt = $db->conn->prepare("SELECT * FROM `users_1`");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            // print_r($row);
            fputcsv($handle, [$row["UID"], $row["Name"], $row["Age"], $row["Email"], $row["Phone"], $row["Gender"]]);
        }
        fclose($handle);
        echo "DONE!";
    }
}
