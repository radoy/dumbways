<?php

require_once 'mysql.php';

// fetch the record from the database
$dObjDb = new Mysql();
$dObjCourse = $dObjDb->query('SELECT course.*, author.name author_name FROM course INNER JOIN author ON author_id = author.id');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dumbways course</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <style>
        .fixed {
            width: 300px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row" style="margin: 5px;">
        <div class="col-sm-5">
            <h2>Dumb-Course</h2>
        </div>
        <div class="col-sm-4">
            <a class="btn btn-sm btn-warning openModal" href="course.php" title="Add course"
               data-modal-size="modal-lg" data-modal-title="Add Course Data">Add Course</a>
            <a class="btn btn-sm btn-warning openModal" href="author.php" title="Add author"
               data-modal-size="modal-lg" data-modal-title="Add Author Data">Add Author</a>
            <a class="btn btn-sm btn-warning openModal" href="content.php" title="Add content"
               data-modal-size="modal-lg" data-modal-title="Add Course Content Data">Add Content</a>
        </div>
    </div>
    <div class="row">
        <?php

        while ($item = $dObjCourse->fetch_object()) {
            ?>
            <div class="col-sm-3" style="margin: 5px;">
                <div class="row border">
                    <div class="fixed">
                        <div class="col-sm-11">
                            <img src="assets/<?php echo $item->thumbnail; ?>" class="img-responsive"/>
                        </div>
                        <div class="col-sm-5">
                            <?php echo $item->name; ?>
                        </div>
                        <div class="col-sm-6">
                            Author: <?php echo $item->author_name; ?>
                        </div>
                        <div class="col-sm-11">
                            <?php echo $item->description; ?>
                        </div>
                        <div class="col-sm-11">
                            <a class="btn btn-sm btn-info openModal"
                               href="content_detail.php?id=<?php echo $item->id; ?>" title="Course detail"
                               data-modal-size="modal-lg" data-modal-title="Course Detail">Detail</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        $dObjDb->close();
        ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mainModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script>
    var strPleaseWait = 'Mohon menunggu...';
    var strErrorLoadData = 'Gagal memuat data. Silakan coba kembali.';

    function showModal(url, title, modalSize, titleClass, clickOutsideClose = true) {
        if (modalSize == null) {
            modalSize = '';
        }

        var mainModal = $("#mainModal");
        if (mainModal.hasClass('in')) {
            mainModal.on('hidden.bs.modal', function () {
                showModal(url, title, modalSize, titleClass, clickOutsideClose);
            }).modal('hide');
        } else {
            var modalBody = mainModal.find('.modal-body');
            var modalHeader = mainModal.find('.modal-header');
            var modalTitle = mainModal.find('.modal-title');
            var modalDialog = mainModal.find('.modal-dialog');

            modalTitle.text(title);
            modalTitle.removeClass();
            modalTitle.addClass('modal-title');
            modalTitle.addClass(titleClass);

            if (title) {
                modalHeader.removeClass('hidden');
            } else {
                modalHeader.addClass('hidden');
            }

            modalDialog.removeClass('modal-lg').removeClass('modal-sm');
            modalDialog.addClass(modalSize);

            mainModal.modal('show');
            modalBody.text(strPleaseWait);

            if (clickOutsideClose) {
                mainModal.removeAttr('data-backdrop');
                mainModal.data('bs.modal').options.backdrop = true;
                mainModal.data('bs.modal').options.keyboard = true;
            } else {
                mainModal.data('bs.modal').options.backdrop = 'static';
                mainModal.data('bs.modal').options.keyboard = false;
            }

            $.ajax({
                url: url,
                dataType: 'html',
            })
                .done(function (result) {
                    modalBody.html(result);
                })
                .fail(function () {
                    alert(strErrorLoadData);
                    mainModal.modal('hide');
                });

            mainModal.off('hidden.bs.modal');
            mainModal.on('hidden.bs.modal', function () {
                window.location.hash = '';
            });
        }
    }

    $("html").on('click', 'a.openModal', function () {
        var elem = $(this);
        var urlToOpen = elem.attr('href');
        var modalSize = elem.data('modal-size');
        var modalTitle = elem.data('modal-title');
        var clickOutsideClose = elem.data('click-outside-close');

        showModal(urlToOpen, modalTitle, modalSize, '', clickOutsideClose);
        return false;
    });
</script>

</body>
</html>