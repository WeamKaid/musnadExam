$(document).ready(function() {
    loadComments();

    $('#submitComment').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'submit_comment.php',
            data: $(this).serialize(),
            success: function(response) {
                alert('Comment submitted successfully!');
                $('#comment').val('');
                $('#rating').val('');
                loadComments();
            },
            error: function() {
                alert('Error submitting comment!');
            }
        });
    });
});

function loadComments() {
    $.ajax({
        url: 'get_comments.php',
        method: 'GET',
        success: function(data) {
            $('#comments-section').html(data);
        }
    });
}
