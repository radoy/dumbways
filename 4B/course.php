<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once 'mysql.php';

if ($_POST) {
    require_once 'utils.php';

    $dStrTargetDir = "assets/";
    $dStrFile = $dStrTargetDir . basename($_FILES["thumbnail"]["name"]);
    $dStrFileType = strtolower(pathinfo($dStrFile,PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $dStrFile)) {
        //store the data to db
        $dObjDb = new Mysql();
        $dObjDb->insert([
            'name' => removeQuote($_POST['course_name']),
            'thumbnail' => $_FILES["thumbnail"]["name"],
            'author_id' => removeQuote($_POST['author_id']),
            'duration' => removeQuote($_POST['duration']),
            'description' => removeQuote($_POST['description']),
        ], 'course');
        header('Location: index.php');
        die();
    }
}

// fetch the record from the database
$dObjDb = new Mysql();
$dObjAuthor = $dObjDb->query('SELECT * FROM author ORDER BY name');

?>

    <div class="row">
        <form class="custom-form col-md-10 col-sm-10 form-horizontal" action="course.php" enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label class="control-label col-sm-3 control-label">
                    Nama Course
                </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="course_name" maxlength="255">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3 control-label">
                    Thumbnail
                </label>
                <div class="col-sm-8">
                    <input type="file" name="thumbnail">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3 control-label">
                    Author
                </label>
                <div class="col-sm-8">
                    <select name="author_id" class="form-control">
                        <?php
                        while ($item = $dObjAuthor->fetch_object()) {
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
                    Duration
                </label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="duration">
                    <p class="help-block ">Minutes</p>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3 control-label">Description</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="description" rows="4"></textarea>
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