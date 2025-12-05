<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ------------------ Handle like post ------------------
    if (isset($_POST['like_post_id'])) {
        $post_id = intval($_POST['like_post_id']);

        $stmt = $conn->prepare("UPDATE posts SET likes = likes + 1 WHERE id = ?");
        $stmt->bind_param("i", $post_id);
        $stmt->execute();
        $stmt->close();

        echo "success";
        exit;
    }

    // ------------------ Handle like reply ------------------
    if (isset($_POST['like_reply_id'])) {
        $reply_id = intval($_POST['like_reply_id']);

        $stmt = $conn->prepare("UPDATE replies SET likes = likes + 1 WHERE id = ?");
        $stmt->bind_param("i", $reply_id);
        $stmt->execute();
        $stmt->close();

        echo "success";
        exit;
    }

    // ------------------ Handle new post ------------------
    if (isset($_POST['author']) && isset($_POST['content']) && !isset($_POST['reply_post_id'])) {
        $author = $_POST['author'] ?: "Anonymous";
        $content = $_POST['content'];

        date_default_timezone_set('Asia/Manila');
        $created_at = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO posts (author, content, created_at, likes) VALUES (?, ?, ?, 0)");
        $stmt->bind_param("sss", $author, $content, $created_at);
        $stmt->execute();
        $stmt->close();

        echo "success";
        exit;
    }

    // ------------------ Handle replies ------------------
    if (isset($_POST['reply_post_id']) && isset($_POST['reply_content'])) {
        $post_id = intval($_POST['reply_post_id']);
        $parent_id = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : NULL;
        $author = $_POST['reply_author'] ?: "Anonymous";
        $content = $_POST['reply_content'];

        date_default_timezone_set('Asia/Manila');
        $created_at = date('Y-m-d H:i:s');

        $stmt = $conn->prepare("INSERT INTO replies (post_id, parent_id, author, content, likes, created_at) VALUES (?, ?, ?, ?, 0, ?)");
        $stmt->bind_param("iisss", $post_id, $parent_id, $author, $content, $created_at);
        $stmt->execute();
        $stmt->close();

        echo "success";
        exit;
    }
}
