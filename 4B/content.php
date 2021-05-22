<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'mysql.php';

if ($_POST) {
    require_once 'utils.php';
    //store the data to db
    $dObjDb = new Mysql();
    $dObjDb->insert([
        'name' => removeQuote($_POST['name']),
        'video_link' => removeQuote($_POST['link']),
        'id_course' => removeQuote($_POST['course_id']),
        'type' => removeQuote($_POST['type']),
    ], 'content');

    header('Location: index.php');
    die();
}

// fetch the record from the database
$dObjDb = new Mysql();
$dObjCourse = $dObjDb->query('SELECT * FROM course ORDER BY name');

?>

    <div class="row">
        <form class="custom-form col-md-10 col-sm-10 form-horizontal" action="content.php" method="post">
            <div class="form-group">
                <label class="control-label col-sm-3 control-label">
                    Nama
                </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" maxlength="255">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3 control-label">
                    Nama Course
                </label>
                <div class="col-sm-8">
                    <select name="course_id" class="form-control">
                        <?php
                        while ($item = $dObjCourse->fetch_object()) {
                            ?>
                            <option value="<?php echo $item->id; ?>">
                                <?php echo $item->name; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3 control-label">
                    Video Link
                </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="link">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3 control-label">
                    Type
                </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="type" maxlength="255">
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

<?php
$dObjDb->close();