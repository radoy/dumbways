<?php
if ($_POST) {
    require_once 'mysql.php';
    require_once 'utils.php';

    //store the data to db
    $dObjDb = new Mysql();
    $dObjDb->insert(['name' => removeQuote($_POST['name'])], 'author');
    header('Location: index.php');
    die();
}
?>

<div class="row">
    <form class="custom-form col-md-10 col-sm-10 form-horizontal" action="author.php" method="post">
        <div class="form-group field-userprofile-firstname">
            <label class="control-label col-sm-3 control-label">
                Nama Lengkap
            </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="name" maxlength="255">
            </div>
        </div>
        <div class="form-group">
            <span class="col-sm-3">&nbsp;</span>
            <div class="col-sm-8">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
</div>
