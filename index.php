<!DOCTYPE html>
<html>
<head>
    <title>AJAX for Database Operations | bishrulhaq.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container" style="margin-top: 20px;">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center">AJAX for Database Operations</h1>

        </div>
    </div>
</div>
<div class="container" style="margin-top: 25px;">
    <div class="row">
        <div class="col-12">
            <div class="text-center">
                <h5>Add New Record</h5>
            </div>
            <div class="form-inline" style="margin-bottom: 25px;">
                <div class="form-group col-3">
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control"/>
                </div>
                <div class="form-group col-3">
                    <input type="text" name="username" id="username" placeholder="Username" class="form-control"/>
                </div>
                <div class="form-group col-3">
                    <input type="text" id="password" name="password" placeholder="Password" class="form-control"
                           required/>
                </div>
                <div class="form-group col-3">
                    <button type="button" class="btn btn-primary" id="add" name="add" onclick="addRecord()">Add Record
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div id="link-edit">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div id="records_content"></div>
            <div class="col-12" id="table_content">
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

    $(document).ready(function () {

        $.get("view.php", function (data) {
            $("#table_content").html(data);
        });
    });

    function addRecord() {

        var name = $('#name').val();
        var username = $('#username').val();
        var password = $('#password').val();

        $.ajax({
            url: "add.php",
            type: "POST",
            data: {name: name, username: username, password: password},
            success: function (data, status, xhr) {
                $('#name').val('');
                $('#username').val('');
                $('#password').val('');
                $.get("view.php", function (html) {
                    $("#table_content").html(html);
                });
                $('#records_content').fadeOut(1100).html(data);
            },
            error: function () {
                $('#records_content').fadeIn(3000).html('<div class="text-center">Error!</div>');
            },
            beforeSend: function () {
                $('#records_content').fadeOut(700).html('<div class="text-center">Loading...</div>');
            }
        });
    }

</script>
</body>
</html>