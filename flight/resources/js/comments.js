$( document ).ready(function() {
    ajaxLoadComments();

    $('.comments_wrapper').on('click', '.add_comment', toggleCommentForm);
    $('.comments_wrapper').on('click', '.submit_comment', submitComment);
});

function ajaxLoadComments() {
    $.ajax({
        url : 'api.php/comments',
        type : 'GET',
        dataType:'json',
        success : loadComments,
        error : function(request,error)
        {
            alert("Request: "+JSON.stringify(request));
        }
    });
}

/**
 * Loads in parent comments
 * @param data
 */

function loadComments(data) {

    var $comment_html = $('.comment.placeholder').clone();
    $comment_html.removeClass('placeholder');

    $.each(data, function(index, comment){
        //var level = 0;
        $comment_html.data('id', comment.id);
        $comment_html.find('.comment_name').html(comment.name);
        $comment_html.find('.comment_date').html(getReadableTimestamp(comment.inserted_at));
        $comment_html.find('.comment_text').html(comment.comment);
        $comment_html.find('.add_comment_form').data('parent_id', comment.id).attr('data-parent_id', comment.id);

        var children = comment.children;
        loadChildren(children, $comment_html);
        $('.comments_wrapper').append($comment_html);
        $comment_html = $('.comment.placeholder').clone();
        $comment_html.removeClass('placeholder');
    });
}

/**
 * loads in child comments
 * @param data
 * @param $parent
 * @param level
 */
function loadChildren(data, $parent, level = 1) {
    $.each(data, function(index, child) {

        var $child_html = $('.comment.placeholder').clone();
        $child_html.removeClass('placeholder');
        $child_html.find('.comment_name').html(child.name);
        $child_html.find('.comment_date').html(getReadableTimestamp(child.inserted_at));
        $child_html.find('.comment_text').html(child.comment);
        $child_html.find('.add_comment_form').data('parent_id', child.id).attr('data-parent_id', child.id);

        if (level > 2) {
            $child_html.find('.add_comment_form').remove();
            $child_html.find('.add_comment').remove();
        }
        $parent.find('.child').first().append($child_html);
        if (child.children !== undefined) {
            level++;
            loadChildren(child.children, $child_html, level);
        }
    });

}

function getReadableTimestamp(timestamp) {
    var newDate = new Date(timestamp);
    return dateString = newDate.toUTCString();
}

function toggleCommentForm(e) {
    $(e.target).parent().find('.add_comment_form').first().toggle();
}

function submitComment(e) {
    var $form = $(e.target).closest('.add_comment_form');
    var data = {
       name: $form.find('input[name="name"]').val(),
       comment: $form.find('textarea').val(),
       parent_id: $form.data('parent_id')
    };

    //Super simple validation because we dont want blanks.
    if (data.name == null || data.name == '') {
        console.log('name cannot be blank');
        return;
    }

    if (data.comment == null || data.comment == '') {
        console.log('comment cannot be blank');
        return;
    }

    $.ajax({
        url : 'api.php/comment',
        type : 'POST',
        data : data,
        dataType:'json',
        success : addComment
    });

    $form.find('input[name="name"]').val('');
    $form.find('textarea').val('');
    if(data.parent_id != "0") {
        $form.toggle();
    }

}

function addComment(data) {
    var $comment_html = $('.comment.placeholder').clone();
    $comment_html.removeClass('placeholder');
    $comment_html.data('id', data.id);
    $comment_html.find('.comment_name').html(data.name);
    $comment_html.find('.comment_date').html(getReadableTimestamp(data.inserted_at));
    $comment_html.find('.comment_text').html(data.comment);
    $comment_html.find('.add_comment_form').data('parent_id', data.id).attr('data-parent_id', data.id);

    if(data.parent_id == "0") {
        $($comment_html).insertAfter('.comment.placeholder');
    } else {

        if ($('.add_comment_form[data-parent_id="' + data.parent_id + '"]').parent().find('.child').first().parentsUntil('.comments_wrapper', '.child').length >= 3) {
            $comment_html.find('.add_comment_form').remove();
            $comment_html.find('.add_comment').remove();
        }
        $('.add_comment_form[data-parent_id="' + data.parent_id + '"]').parent().find('.child').first().prepend($comment_html);
    }

}