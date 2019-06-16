<?php
require_once('config.php');

$id = $_POST['id'];

if (empty($id)) {
    echo '<div class="col-md-offset-4 col-md-5 text-center alert alert-danger">Error!</div>';
}
$query = $con->prepare("DELETE FROM student where id= ?");

$query->bind_param('i', $id);

$result = $query->execute();

if ($result) {
    echo '<div class="col-md-offset-4 col-md-5 text-center alert alert-success">1 Record Deleted!</div>';
} else {
    exit(mysqli_error($con));
}