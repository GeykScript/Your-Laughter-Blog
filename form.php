

<?php
include 'connect.php';
// ------------------ Handle new post ------------------
if (isset($_POST['author']) && isset($_POST['content']) && !isset($_POST['reply_post_id'])) {
    $author = $_POST['author'] ?: "Anonymous";
    $content = $_POST['content'];

    // Get current local time in PHP (UTC+8)
    date_default_timezone_set('Asia/Manila');

    $created_at = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO posts (author, content, created_at) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $author, $content, $created_at);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php#share-thoughts");
    exit;
}

// ------------------ Handle new reply ------------------
if (isset($_POST['reply_post_id']) && isset($_POST['reply_content'])) {
    $post_id = intval($_POST['reply_post_id']);
    $parent_id = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : NULL;
    $author = $_POST['reply_author'] ?: "Anonymous";
    $content = $_POST['reply_content'];

    // Get current local time in PHP (UTC+8)
    date_default_timezone_set('Asia/Manila');

    $created_at = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO replies (post_id, parent_id, author, content, likes, created_at) VALUES (?, ?, ?, ?, 0, ?)");
    $stmt->bind_param("iisss", $post_id, $parent_id, $author, $content, $created_at);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php#share-thoughts");
    exit;
}

// ------------------ Handle likes ------------------
if (isset($_POST['like_post_id'])) {
    $post_id = intval($_POST['like_post_id']);
    // Get current local time in PHP (UTC+8)
    date_default_timezone_set('Asia/Manila');
    $updated_at = date('Y-m-d H:i:s');

    $conn->query("UPDATE posts SET likes = IFNULL(likes,0) + 1, updated_at = '$updated_at' WHERE id=$post_id");
    header("Location: index.php#share-thoughts");
    exit;
}

if (isset($_POST['like_reply_id'])) {
    $reply_id = intval($_POST['like_reply_id']);
    date_default_timezone_set('Asia/Manila');
    $updated_at = date('Y-m-d H:i:s');

    $conn->query("UPDATE replies SET likes = IFNULL(likes,0) + 1, updated_at = '$updated_at' WHERE id=$reply_id");
    header("Location: index.php#share-thoughts");
    exit;
}


// ------------------ Fetch posts ------------------
$posts = $conn->query("SELECT * FROM posts ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);

// ------------------ Fetch replies ------------------
$replies_result = $conn->query("SELECT * FROM replies ORDER BY created_at ASC")->fetch_all(MYSQLI_ASSOC);

// Build nested replies tree
$replies_tree = [];
foreach ($replies_result as $r) {
    $parent = $r['parent_id'] ?: 0;
    $replies_tree[$r['post_id']][$parent][] = $r;
}

function display_replies($post_id, $parent_id, $replies_tree)
{
    if (isset($replies_tree[$post_id][$parent_id])) {
        foreach ($replies_tree[$post_id][$parent_id] as $reply) {
            echo '<div class="ml-' . ($parent_id ? '8' : '0') . ' mt-2 p-4 bg-sky-50 rounded-lg">';
            echo '<p class="text-gray-700 text-sm break-words leading-relaxed">' . htmlspecialchars($reply['content']) . '</p>';
            echo '<p class="text-xs text-gray-500 my-1">— ' . htmlspecialchars($reply['author']) . ' on ' . date("m/d/Y H:i", strtotime($reply['created_at'])) . '</p>';

            echo '<div class="flex items-center gap-4">';

            // Like reply
            echo '<form method="POST">
                    <input type="hidden" name="like_reply_id" value="' . $reply['id'] . '">
                    <button type="submit" class="flex items-center text-red-600 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#e90e0eff" viewBox="0 0 24 24" stroke-width="1.5" stroke="#e90e0eff" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.015-4.5-4.5-4.5-1.74 0-3.285.992-4.05 2.457C11.285 4.742 9.74 3.75 8 3.75 5.515 3.75 3.5 5.765 3.5 8.25c0 7.22 8.5 12 8.5 12s8.5-4.78 8.5-12z" />
                        </svg>
                        <span>' . ($reply['likes'] ?: 0) . '</span>
                    </button>
                  </form>';

            // Reply button for nested reply
            echo '<form method="POST" class="mt-1 reply-form">
                    <input type="hidden" name="reply_post_id" value="' . $post_id . '">
                    <input type="hidden" name="parent_id" value="' . $reply['id'] . '">
                    <input type="text" name="reply_author" placeholder="Your Name (optional)" class="reply-author hidden w-full border border-sky-200 rounded-sm p-1 mb-1 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
                    <textarea name="reply_content" placeholder="Write a reply..." class="reply-content hidden w-full border border-sky-200 rounded-sm p-1 mb-1 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none resize-none" rows="1"></textarea>
                    <button type="button" class="show-reply-btn text-sky-500 hover:text-sky-600 px-2 py-1 rounded-sm transition text-sm">Reply</button>
                    <button type="submit" class="reply-submit hidden text-sky-500 hover:text-sky-600 px-2 py-1 rounded-sm transition text-sm">Reply</button>
                  </form>';

            echo '</div>';

            // Recursive call for nested replies
            display_replies($post_id, $reply['id'], $replies_tree);

            echo '</div>';
        }
    }
}

?>