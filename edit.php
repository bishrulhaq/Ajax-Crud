<?php
require_once('config.php');
$id = $_POST['id'];

if (empty($id)) { ?>
    <div class="text-center">No records found under this selection <a href="#" onclick="$('#link-add').hide();$('#show-add').show(700);">Hidethis</a></div>
    <?php die();
}

$query = "SELECT * FROM student where id = ?";
if ($stmt = $con->prepare($query)) {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
    ?>
    <div class="form-inline" id="edit-data" style="margin-bottom: 20px;">
        <div class="form-group col-3">
            <input type="text" name="student_name" id="student_name" value="<?php echo $row['name']; ?>"
                   placeholder="Name" class="form-control" required/>
        </div>
        <div class="form-group col-3">
            <input type="text" name="student_username" id="student_username" placeholder="Username" class="form-control"
                   value="<?php echo $row['username']; ?>" required/>
        </div>
        <div class="form-group col-3">
            <input type="text" id="student_password" name="student_password" placeholder="Password" class="form-control"
                   value="<?php echo $row['password']; ?>" required/>
        </div>
        <div class="form-group col-3">
            <button type="button" class="btn btn-primary update" id="<?php echo $row['id']; ?>" name="update"
                    onclick="updateRecord(<?php echo $row['id']; ?>)">Update Record
            </button>
            <button type="button" href="javascript:void(0);" class="btn btn-default" id="cancel"
                    onclick="$('#link-edit').slideUp(400);$('#show-add').show(700);">Cancel
            </button>
        </div>
    </div>
<?php }}}} ?>

<script type="text/javascript">
    function updateRecord(student_id) {

        var id = student_id;
        var name = $('#student_name').val();
        var username = $('#student_username').val();
        var password = $('#student_password').val();

        $.ajax({
            url: "update.php",
            type: "POST",
            data: {id: id, name: name, username: username, password: password},
            success: function (data, status, xhr) {
                $('#name').val('');
                $('#username').val('');
                $('#password').val('');
                $('#records_content').fadeOut(1100).html(data);
                $.get("view.php", function (html) {
                    $("#table_content").html(html);
                });
                $('#records_content').fadeOut(1100).html(data);
            },
            complete: function () {
                $('#link-edit').hide();
                $('#show-add').show(700);
            }
        });
    }
</script>
