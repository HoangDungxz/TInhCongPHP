<!doctype html>

<head>
    <meta charset="utf-8">

    <title>MVC Todo</title>

    <link href="./Views\assets\bootstrap.min.css" rel="stylesheet">

    <style>
        ul,
        li {
            margin: 0;
            padding: 0;
        }

        ul {
            list-style: none;
        }

        a:hover {
            text-decoration: none;

        }

        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }

        .nav-link {
            cursor: pointer;
            font-size: 1.5rem;
            padding: 0 15px;
        }

        .main {
            margin-top: 56px;
            overflow: scroll;
            height: calc(99vh - 60px);
        }

        table,
        th,
        td {
            border: 3px solid white;
            border-collapse: collapse;
        }

        .navbar-menu {
            cursor: pointer;
            width: 60px;
            margin: 0;
            padding-left: 1rem;
            margin-left: -1rem;
        }

        .icon-bars-button {
            display: inline-block;
            vertical-align: middle;
            cursor: pointer;
        }

        .icon-bar {
            margin-bottom: 2px;
            display: block;
            width: 22px;
            height: 2px;
            background-color: #cccccc;
            border-radius: 1px;
        }

        .navbar-brand:hover {
            color: red !important;
        }

        .navbar-brand:hover .icon-bar {
            background-color: red !important;
        }

        .menu-content {
            width: fit-content;
            height: 100%;
            margin-top: 56px;

        }

        .menu-bar {
            width: 100%;
            height: 100%;

            display: none;
            position: fixed;
            top: 0;
        }

        .menu-bar-main {
            background-color: #333;
            z-index: 9999;
        }

        .menu-content {
            padding: 10px 20px;

        }

        .menu-content label,
        .menu-content strong {
            white-space: nowrap;
            color: rgba(255, 255, 255, .5);
            cursor: pointer;
        }

        .menu-content strong {
            font-size: 1.5rem;
            margin-top: 30px;
            margin-bottom: 20px;
            display: block;
            cursor: default;
        }

        .menu-content label:hover {
            color: #fff;
        }

        .menu-close {
            width: 100%;
            background-color: #333;
            width: 100%;
            height: 100%;
            opacity: .3;
        }

        .select-nemu label {
            margin-bottom: 0;
            color: rgba(255, 255, 255, .5);
            font-size: 1.5rem;
            cursor: pointer;
        }

        .select-nemu-child label {
            margin-bottom: 0;
            color: rgba(255, 255, 255, .5);
            font-size: 1.5rem;
            cursor: pointer;
            margin: 0 20px;
        }

        .select-nemu:hover label,
        .select-nemu-child:hover label {
            color: rgba(255, 255, 255, 1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-menu navbar-brand" id="navbar_menu_btn">
            <span class="icon-bars-button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </span></a>
        <div class="select-nemu">
            <label id="title"><?= isset($fileName) ? $fileName : "" ?>Bảng chấm công</label>
            <input type="hidden" id="title_value" value="<?= isset($fileName) ? $fileName : "" ?>">
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav w-100">
                <li class="nav-item">
                    <div class="select-nemu-child">
                        <label id="workTime"><?= isset($fileName) ? $fileName : "" ?>Tính công</label>
                        <input type="hidden" id="title_value" value="<?= isset($fileName) ? $fileName : "" ?>">
                    </div>
                </li>
                <li class="nav-item ml-auto d-flex">
                    <a class="nav-link" href="./index.php?controller=TinhCong&action=download" id="nav_link_dowload">Tải xuống <span class="sr-only">(current)</span></a>

                    <a class="nav-link" id="nav_link_upload">Tải lên <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <main role="main" class="main">

        <div class="menu-bar" id="menu_bar">
            <div class="d-flex h-100">
                <div class="menu-bar-main" id="menu_bar_main">
                </div>
                <div class="menu-close menu-close-action"></div>
            </div>

        </div>
        <div class="content" id="content">
        </div>

        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <!-- Modal -->
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Chọn excel files</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="uploadModalForm" enctype="multipart/form-data" method="POST">
                            <div class="excel-file">
                                <input type="file" class="excel-file-input" name="excelFile" id="excelFile">
                                <label class="excel-file-label" for="excelFile">Choose file</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="uploadModalFormBtn" class="btn btn-primary">Tải lên</button>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <script src="./Views/assets/jquery-3.6.0.js"></script>
    <script src="./Views/assets/popper.min.js"></script>
    <script src="./Views/assets/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#nav_link_upload").click(function() {
                $("#uploadModal").modal("show");
            });
        });
    </script>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        $('#uploadModalFormBtn').on('click', function() {
            var file_data = $('#excelFile').prop('files')[0];
            var form_data = new FormData();
            form_data.append('excelFile', file_data);

            $.ajax({
                url: './index.php?controller=TinhCong&action=upload', // <-- point to server-side PHP script 
                dataType: 'text', // <-- what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(php_script_response) {
                    $("#uploadModal").modal("hide");
                    $('#content').html(php_script_response);

                }
            });
        });


        $('#workTime').on('click', function() {
            $.ajax({
                url: './index.php?controller=TinhCong&action=showWorkTime', // <-- point to server-side PHP script 
                dataType: 'text', // <-- what to expect back from the PHP script, if anything
                success: function(php_script_response) {
                    $('#content').html(php_script_response);
                }
            });
        });

        $('#navbar_menu_btn').click(function() {
            $.ajax({
                url: './index.php?controller=Excels&action=menu', // <-- point to server-side PHP script 
                dataType: 'text', // <-- what to expect back from the PHP script, if anything
                type: 'post',
                success: function(php_script_response) {
                    $('#menu_bar_main').html(php_script_response);
                    $('#menu_bar').animate({
                        width: 'toggle'
                    });
                    // $('.navbar').toggleClass('menu-close-action');
                }
            });
        });

        $('.menu-close-action').on('click', function() {
            $('#menu_bar').animate({
                width: 'hide'
            });
        });
    </script>
</body>

</html>