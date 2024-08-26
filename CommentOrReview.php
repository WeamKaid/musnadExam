<?php
require_once 'DB.php';
require_once 'model.php';

$database = new Database();
$db = $database->connect();
$comment = new Comment($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add_comment':
                if (isset($_POST['content_id'], $_POST['user_id'], $_POST['content'], $_POST['rating'])) {
                    $comment->content_id = $_POST['content_id'];
                    $comment->user_id = $_POST['user_id'];
                    $comment->content = $_POST['content'];
                    $comment->rating = $_POST['rating'];

                    if ($comment->create()) {
                        echo json_encode(['status' => 'success', 'message' => 'Comment added successfully']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Failed to add comment']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
                }
                break;

            case 'delete_comment':
                if (isset($_POST['comment_id'], $_POST['user_id'])) {
                    $comment->id = $_POST['comment_id'];
                    $comment->user_id = $_POST['user_id'];

                    if ($comment->belongsToUser()) {
                        if ($comment->delete()) {
                            echo json_encode(['status' => 'success', 'message' => 'Comment deleted successfully']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Failed to delete comment']);
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Unauthorized action']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
                }
                break;

            default:
                echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No action specified']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'load_comments' && isset($_GET['content_id'])) {
        $comments = $comment->readAll($_GET['content_id']);
        echo json_encode(['status' => 'success', 'comments' => $comments]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
