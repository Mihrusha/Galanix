<?php

// use App\Model\Model;

// $model = new Model;
// if(isset($_POST['submit'])){
//     $result = $model->Upload();

//     $model->ReadFile($result);
// }

// if(isset($_POST['delete'])){
//     $model->CleanTable();
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Download</title>
</head>

<body>
    <div class='container mt-2'>
        <form action="" method='post' enctype="multipart/form-data">
            <input type="file" name="download" id="download">
            <a href="App\View\Template\results.php" class='btn btn-primary' name='result_page'>View Results</a>
            <button type='submit'name='submit' class='btn btn-success'>Import</button>
            <!-- <input type="submit" class='btn btn-success' value='Import' name='submit'> -->
            <button class='btn btn-danger' name='delete'>Clear Records</button>
        </form>
    </div>


</body>

</html>