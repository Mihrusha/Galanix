<?php

use App\Model\Model;

include_once 'C:\xampp\htdocs\Galanix\vendor\autoload.php';
$model = new Model;

$result = $model->GetAll();

if ($result == 0) {
    echo 'No records in Database';
}

if (isset($_POST['export'])) {
    $model->Export();
}
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
    <title>Result</title>
</head>

<body>
    <div class='container'>
        <a href="/Galanix/index.php" class='btn btn-primary'>Import Data</a>




        <ul class='navbar inline'>
            <li>
                <div class='container '>
                    <label for="UID">UID</label>
                    <input type="text" id='UID' class="form-control">
                </div>
            </li>
            <li>
                <div class='container'>
                    <label for="Name">Name</label>
                    <input type="text" id='Name' class="form-control">
                </div>
            </li>
            <li>
                <div class='container'>
                    <label for="Age">Age</label>
                    <input type="text" id='Age' class="form-control">
                </div>
            </li>
            <li>
                <div class='container'>
                    <label for="Email">Email</label>
                    <input type="text" id='Email' class="form-control">
                </div>
            </li>
            <li>
                <div class='container'>
                    <label for="Phone">Phone</label>
                    <input type="text" id='Phone' class="form-control">
                </div>
            </li>

            <li>
                <label for="Gender">Gender</label>
                <div class='container'>

                    <select name="gender" id="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </li>
        </ul>

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Gender</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php foreach ($result as $row) : ?>
                    <tr>
                        <td class='col1'><?= $row['UID'] ?></td>
                        <td><?= $row['Name'] ?></td>
                        <td class='col3'><?= $row['Age'] ?></td>
                        <td><?= $row['Email'] ?></td>
                        <td><?= $row['Phone'] ?></td>
                        <td class='col6'><?= $row['Gender'] ?></td>
                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>

        <form action="" method='post'>
            <a href="/Galanix/App/View/Template/export.csv" id='link' style='display:none;' download>Download Files</a>
            <button type='submit' class='btn btn-warning' name='export' id='export'>Export to CSV</button>
        </form>


    </div>
    <script>
        $.expr[":"].exact = $.expr.createPseudo(function(arg) {

            return function(element) {

                return $(element).text() === arg.trim();

            };

        });

        $("#UID").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).find("td:eq(0)").text().toLowerCase().toLowerCase() == value)
            });
        });



        $("#Name").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).find("td:eq(1)").text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#Age').on("keyup", function() {


            $("#myTable td.col3:contains('" + $(this).val() + "')").parent().show();

            $("#myTable td.col3:not(:contains('" + $(this).val() + "'))").parent().hide();
        });



        $("#Email").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).find("td:eq(3)").text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#Phone").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).find("td:eq(4)").text().toLowerCase().indexOf(value) > -1)
            });
        });

        

        $("#gender").on("change", function() {
            var value = $('#gender').val().toLowerCase();


            $("#myTable tr").filter(function() {
                $(this).toggle($(this).find("td:eq(5)").text().toLowerCase() == value)
            });
        });



        $('#export').click(function() {
            document.getElementById("link").click()
        })

        $('th').click(function() {
            var table = $(this).parents('table').eq(0)
            var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
            this.asc = !this.asc
            if (!this.asc) {
                rows = rows.reverse()
            }
            for (var i = 0; i < rows.length; i++) {
                table.append(rows[i])
            }
        })

        function comparer(index) {
            return function(a, b) {
                var valA = getCellValue(a, index),
                    valB = getCellValue(b, index)
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
            }
        }

        function getCellValue(row, index) {
            return $(row).children('td').eq(index).text()
        }
    </script>
</body>

</html>