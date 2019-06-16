<?php
require_once('config.php');
$query = $con->prepare("SELECT * FROM student order by id DESC");
$query->execute();
mysqli_stmt_bind_result($query, $id, $name, $username, $password); ?>
<table class="table table-bordered">
    <tr class="info">
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Password</th>
        <th>Action</th>
    </tr>
    <?php while (mysqli_stmt_fetch($query)) { ?>
        <tr>
            <td><?php echo $id; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $username; ?></td>
            <td><?php echo $password; ?></td>
            <td>
                <button class="edit btn btn-info" onclick="editRecord(<?php echo $id; ?>)">Edit</button>
                <button class="del btn btn-danger" onclick="deleteRecord(<?php echo $id; ?>)">Delete</button>
            </td>
        </tr>
    <?php } ?>
</table>
<script>
    function deleteRecord(student_id) {
        $.ajax({
            url: "delete.php",
            type: "POST",
            data: {id: student_id},
            success: function (data) {
                $('#records_content').fadeOut(1100).html(data);
                $.get("view.php", function (data) {
                    $("#table_content").html(data);
                });
            }
        });
    }

    function editRecord(student_id) {
        $.ajax({
            url: 'edit.php',
            type: 'POST',
            data: {id: student_id},
            success: function (data) {
                $("#link-edit").html(data);
                $('#link-edit').show();
            }
        });
    }
</script>