<html>
<head>
    <script src="resources/js/jquery-3.3.1.min.js"></script>
    <script src="resources/js/comments.js"></script>
    <script src="resources/bootstrap/js/bootstrap.js"></script>
    <script src="resources/bootstrap/js/bootstrap.bunbdle.js"></script>
    <link rel="stylesheet" href="resources/css/comments.css">
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap-reboot.css">
</head>


<body>
    <div class="container-fluid">
        <div class="header"><h1>TMBC Coding Challenge</h1></div>

        <div class="comments_wrapper">
            <div class="add_comment_form form-group" data-parent_id='0'>
                <div class="new_name form-control"><label>Name: </label><input type="text" name="name"></div>
                <label>Comment: </label><textarea name="comment" class="form-control"></textarea>
                <button class="submit_comment"> Submit</button>
            </div>
            <div class="comment placeholder">
                <div class="comment_name_wrapper">
                    <h6 class="comment_name"> </h6>
                </div>
                <div class="comment_date"></div>
                <div class="comment_text"> </div>
                <div class="add_comment">Add Comment</div>
                <div class="add_comment_form hide form-group">
                    <div class="new_name form-control"><label>Name: </label><input type="text" name="name"></div>
                    <label>Comment: </label><textarea name="comment" class="form-control"></textarea>
                    <button class="submit_comment"> Submit</button>
                </div>
                <div class="child"> </div>
            </div>
        </div>
    </div>
</body>

</html>
