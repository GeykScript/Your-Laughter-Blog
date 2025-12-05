<?php

include 'connect.php';

// Get all posts from database
$posts = $conn->query("SELECT * FROM posts ORDER BY created_at DESC")
    ->fetch_all(MYSQLI_ASSOC);

// Build replies tree for each post
foreach ($posts as $i => $post) {
    $post_id = $post['id'];

    $stmt = $conn->prepare("SELECT * FROM replies WHERE post_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();

    $posts[$i]['replies'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
}

// Display posts
foreach ($posts as $post): ?>

    <div class="mb-4 py-4 px-6 bg-white rounded-lg">
        <p class="italic text-gray-800 break-words leading-relaxed">"<?= htmlspecialchars($post['content']) ?>"</p>
        <p class="text-xs text-gray-500 my-2">— posted on <?= date("m/d/Y h:i A", strtotime($post['created_at'])) ?> by <?= htmlspecialchars($post['author']) ?></p>

        <div class="flex items-center gap-4">
            <!-- Like post -->
            <form method="POST" action="form.php" class="like-post-form">
                <input type="hidden" name="like_post_id" value="<?= $post['id'] ?>">
                <button type="submit" class="flex items-center text-red-600 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#e90e0eff" viewBox="0 0 24 24" stroke-width="1.5" stroke="#e90e0eff" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.015-4.5-4.5-4.5-1.74 0-3.285.992-4.05 2.457C11.285 4.742 9.74 3.75 8 3.75 5.515 3.75 3.5 5.765 3.5 8.25c0 7.22 8.5 12 8.5 12s8.5-4.78 8.5-12z" />
                    </svg>
                    <span><?= $post['likes'] ?: 0 ?></span>
                </button>
            </form>

            <!-- Reply form for main post -->
            <form method="POST" class="mt-1 reply-form" action="form.php">
                <input type="hidden" name="reply_post_id" value="<?= $post['id'] ?>">
                <input type="text" name="reply_author" placeholder="Your Name (optional)" class="reply-author hidden w-full border border-sky-200 rounded-sm p-1 mb-1 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
                <textarea name="reply_content" placeholder="Write a reply..." class="reply-content hidden w-full border border-sky-200 rounded-sm p-1 mb-1 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none resize-none" rows="1"></textarea>
                <button type="button" class="show-reply-btn text-sky-500 hover:text-sky-600 px-2 py-1 rounded-sm transition text-sm">Reply</button>
                <button type="submit" class="reply-submit hidden text-sky-500 hover:text-sky-600 px-2 py-1 rounded-sm transition text-sm">Reply</button>
            </form>
        </div>

        <!-- Display nested replies -->
        <div class="mt-2 p-4 bg-sky-50 rounded-lg">
            <?php foreach ($post['replies'] as $reply): ?>
                <div class="reply">
                    <p class="text-gray-700 text-sm break-words leading-relaxed"><?= htmlspecialchars($reply['content']) ?></p>
                    <p class="text-xs text-gray-500 my-1">— <?= htmlspecialchars($reply['author']) ?> on <?= date("m/d/Y h:i A", strtotime($reply['created_at'])) ?></p>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Like reply -->
                    <form method="POST" class="like-reply-form" action="form.php">
                        <input type="hidden" name="like_reply_id" value="<?= $reply['id'] ?>">
                        <button type="submit" class="flex items-center text-red-600 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#e90e0eff" viewBox="0 0 24 24" stroke-width="1.5" stroke="#e90e0eff" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.015-4.5-4.5-4.5-1.74 0-3.285.992-4.05 2.457C11.285 4.742 9.74 3.75 8 3.75 5.515 3.75 3.5 5.765 3.5 8.25c0 7.22 8.5 12 8.5 12s8.5-4.78 8.5-12z" />
                            </svg>
                            <span><?= ($reply['likes'] ?: 0) ?></span>
                        </button>
                    </form>
                    <!-- Reply to reply -->
                    <form method="POST" class="mt-1 reply-form" action="form.php">
                        <input type="hidden" name="reply_post_id" value="<?= $post['id'] ?>">
                        <input type="hidden" name="parent_id" value="<?= $reply['id'] ?>">
                        <input type="text" name="reply_author" placeholder="Your Name (optional)" class="reply-author hidden w-full border border-sky-200 rounded-sm p-1 mb-1 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none">
                        <textarea name="reply_content" placeholder="Write a reply..." class="reply-content hidden w-full border border-sky-200 rounded-sm p-1 mb-1 text-sm focus:ring-2 focus:ring-sky-400 focus:outline-none resize-none" rows="1"></textarea>
                        <button type="button" class="show-reply-btn text-sky-500 hover:text-sky-600 px-2 py-1 rounded-sm transition text-sm">Reply</button>
                        <button type="submit" class="reply-submit hidden text-sky-500 hover:text-sky-600 px-2 py-1 rounded-sm transition text-sm">Reply</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>