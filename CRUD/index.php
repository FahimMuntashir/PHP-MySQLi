<?php

// connect to database

$servername = "localhost";
$username = "root";
$pass = "";
$db = "crudNotes";
$conn = mysqli_connect($servername, $username, $pass, $db);

$insert = false;
// $result = mysqli_query($conn, $sql);

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (isset($_POST['addNote'])) {


    $title = $_POST['title'];
    $des = $_POST['desc'];
    $sql = "INSERT INTO notes (title, descrp)
VALUES('$title', '$des');
";

    $result = mysqli_query($conn, $sql);

    $insert = true;
}


?>

<!-- deleting item -->
<?php

if (isset($_GET['del'])) {
    $stid = $_GET['del'];

    $query  = "DELETE  FROM notes WHERE sno ={$stid}";
    $deleteResult = mysqli_query($conn, $query);
    if ($deleteResult) {
        echo "data removed successfully <br>";
    }
}
?>


<!-- updating data -->

<?php
if (isset($_GET['update'])) {
    $stid = $_GET['update'];

    $updateQuery  = "SELECT * FROM notes WHERE sno ={$stid}";

    $updateResult = mysqli_query($conn, $updateQuery);

    while ($row = mysqli_fetch_assoc($updateResult)) {
        $ntid = $row['sno'];
        $ntitle = $row['title'];
        $ndes = $row['descrp'];


?>
        <form method="post">
            <label for="fname">Title:</label><br>
            <input type="text" id="fname" name="fname" value=<?php echo $ntitle; ?>><br>
            <label for="lname">Description:</label><br>
            <input type="text" id="lname" name="lname" value=<?php echo $ndes; ?>> <br> <br>
            <input type="submit" value="Update" name="update_btn">



        </form>

        <!-- Button trigger modal -->
        <!-- <button type="button" class="update btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="update">
  Launch demo modal
</button> -->

        <!-- Modal -->
        <!-- <div class="modal fade update" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div> -->

<?php

    }
} ?>


<?php
if (isset($_POST['update_btn'])) {


    $ntitle = $_POST['fname'];
    $ndes = $_POST['lname'];

    $query = "UPDATE notes SET title = '$ntitle', descrp = '$ndes' WHERE sno = $ntid";
    $updateQ = mysqli_query($conn, $query);
    if ($updateQ) {
        echo "update successfully";
    }
}
?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Hello, world!</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"> -->
    <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
</head>

<body>




    <?php

    if ($insert) {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Holy guacamole!</strong> Your notes insert successfully...
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>


                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container my-5">

        <h2>Add a Note to <a href="https://fahimmuntashir.com/">f12rNOTES</a> </h2> <br>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <label for="desc">Note Description</label>

            <div class="form-floating">

                <textarea class="form-control" placeholder="" id="desc" name="desc" style="height: 100px"></textarea>
            </div>

            <button type="submit" class="btn btn-primary my-3" name="addNote">Add Note</button>
        </form>
    </div>

    <div class="container" mb-5>



        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.no</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date & Time</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM notes";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $inc = 0;
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                    <!-- <th scope='row'>" . $row['sno'] . "</th> -->
                    <th scope='row'>" . $inc = $inc + 1 . "</th>
                    <td>" . $row['title'] . "</td>
                    <td>" . $row["descrp"] . "</td>
                    <td>" . $row['tStamp'] . "</td>
                    <td><a href='index.php?update={$row['sno']}' <button type='button'  class='btn btn-dark btn-sm'>Update</button> </a> <a href='index.php?del={$row['sno']}' <button type='button' class='btn btn-dark btn-sm'>Delete</button> </a>
                    </td>
                </tr>";
                    }
                }
                ?>




            </tbody>
        </table>
    </div>

    <hr>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>