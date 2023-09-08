<?php
include './db/_dbConnect.php';

$insert = false;
$update = false;
$delete = false;

if (isset($_GET['delete'])) {
    $sno = $_GET['delete'];
    $delete = true;
    $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
    $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];
    
        $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $update = true;
        } else {
            echo "We could not update the record successfully";
        }
    } else {
        $title = $_POST["title"];
        $description = $_POST["description"];
    
        $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
        } else {
            $insert = true;
        }
    }
}
?>

<?php include './includes/header.php'; ?>

<!-- Your HTML content goes here -->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Note</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/php/iNote-PHP/index.php" method="post">
                    <input type="hidden" name="snoEdit" id="snoEdit">
                    <div class="mb-3 form-group">
                        <label for="titleEdit" class="form-label">Node Title</label>
                        <input type="text" class="form-control" id="titleEdit" name="titleEdit">
                    </div>


                    <div class="form-floating mb-3 form-group">
                        <textarea class="form-control" name="descriptionEdit" id="descriptionEdit"></textarea>
                        <label for="descriptionEdit">Note Description</label>
                    </div>



            </div>
            <div class="modal-footer d-block mr-auto">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="container my-4">
    <h2>Add a Note</h2>
    <form action="/php/iNote-PHP/index.php" method="post">
        <div class="mb-3 form-group">
            <label for="title" class="form-label">Note Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-floating mb-3 form-group">
            <textarea class="form-control" name="description" id="description"></textarea>
            <label for="description">Note Description</label>
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
</div>

<div class="container my-4">
    <h3>Your Notes</h3>
    <table class="table" id="myTable">
        <thead>
            <tr>
                <th scope="col">S.No</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `notes`";
            $result1 = mysqli_query($conn, $sql);
            $sno = 1;
            while ($row = mysqli_fetch_assoc($result1)) {
                echo "<tr>
                        <th scope='row'>" . $sno . "</th>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['description'] . "</td>
                        <td>
                            <button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button>
                            <button class='delete btn btn-sm btn-primary' id=d" . $row['sno'] . ">Delete</button>
                        </td>
                    </tr>";
                $sno++;
            }
            ?>
        </tbody>
    </table>
</div>

<?php include './includes/footer.php'; ?>