<?php
require_once('config.php');

$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

if (!empty($name) && !empty($username) && !empty($password) && !empty($id)) {
    $query = "UPDATE student SET name = ?, username = ?, password = ? WHERE id = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("sssi", $name, $username, $password, $id);
        $stmt->execute();
        if ($stmt->error) {
            echo '<div class="col-md-offset-4 col-md-5 text-center alert alert-danger">' . $stmt->error . '</div>';
        } else {
            echo '<div class="col-md-offset-4 col-md-5 text-center alert alert-success">1 Record updated!</div>';

        }
    }
} else {
    echo '<div class="col-md-offset-4 col-md-5 text-center alert alert-danger">error while updating record</div>';
}