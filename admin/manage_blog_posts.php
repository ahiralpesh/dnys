<!-- admin/manage_blog_posts.php - Admin: Manage Blog Posts -->
<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blog Posts - Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Inter", sans-serif;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important;
        }
        .admin-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .btn-primary, .btn-success, .btn-warning, .btn-danger {
            border-radius: 8px;
        }
        .table {
            margin-top: 20px;
        }
        .table thead th {
            background-color: #e9ecef;
        }
        .modal-content {
            border-radius: 10px;
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Admin Panel for <?php echo APP_NAME; ?></a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Welcome, Admin <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>!</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container admin-container">
        <h2 class="text-center mb-4">Manage Blog Posts</h2>

        <?php
        // admin/manage_blog_posts.php - PHP backend for blog post management

        if (!isLoggedIn() || !isAdmin()) {
            redirect('../login.php');
        }

        $message = '';
        $message_type = '';

        // Function to generate a slug
        function generateSlug($text) {
            $text = preg_replace('~[^\pL\d]+~u', '-', $text); // Replace non-alphanumeric with a dash
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text); // Transliterate
            $text = preg_replace('~[^-\w]+~', '', $text); // Remove unwanted characters
            $text = trim($text, '-'); // Trim dashes from start/end
            $text = preg_replace('~-+~', '-', $text); // Replace multiple dashes with a single one
            $text = strtolower($text); // Convert to lowercase
            return empty($text) ? 'n-a' : $text;
        }

        // Handle Add/Update Blog Post
        if (isset($_POST['submit_post'])) {
            $title = sanitizeInput($_POST['title']);
            $content = $_POST['content']; // HTML content, don't sanitize with htmlspecialchars
            $status = sanitizeInput($_POST['status']);
            $post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
            $author_id = $_SESSION['user_id'];
            $slug = generateSlug($title);

            if (empty($title) || empty($content) || empty($status)) {
                $message = 'All fields are required.';
                $message_type = 'danger';
            } else {
                try {
                    $pdo->beginTransaction();

                    if ($post_id > 0) {
                        // Update existing post
                        $stmt = $pdo->prepare("UPDATE blog_posts SET title = ?, slug = ?, content = ?, status = ?, author_id = ? WHERE id = ?");
                        $stmt->execute([$title, $slug, $content, $status, $author_id, $post_id]);
                        $message = 'Blog post updated successfully!';
                    } else {
                        // Add new post
                        $stmt = $pdo->prepare("INSERT INTO blog_posts (title, slug, content, author_id, status) VALUES (?, ?, ?, ?, ?)");
                        $stmt->execute([$title, $slug, $content, $author_id, $status]);
                        $message = 'Blog post added successfully!';
                    }

                    $pdo->commit();
                    $message_type = 'success';

                } catch (PDOException $e) {
                    $pdo->rollBack();
                    $message = 'Error: ' . $e->getMessage();
                    $message_type = 'danger';
                }
            }
        }

        // Handle Delete Blog Post
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $post_id = (int)$_GET['id'];
            try {
                $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
                $stmt->execute([$post_id]);
                $message = 'Blog post deleted successfully!';
                $message_type = 'success';
            } catch (PDOException $e) {
                $message = 'Error deleting blog post: ' . $e->getMessage();
                $message_type = 'danger';
            }
        }
        ?>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?> rounded-lg" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEditPostModal" id="addPostBtn">
            Add New Blog Post
        </button>

        <!-- Blog Post List -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Existing Blog Posts</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $stmt = $pdo->query("SELECT bp.id, bp.title, bp.slug, bp.status, bp.created_at, u.username AS author_username
                                                     FROM blog_posts bp
                                                     LEFT JOIN users u ON bp.author_id = u.id
                                                     ORDER BY bp.created_at DESC");
                                $posts = $stmt->fetchAll();

                                if (empty($posts)) {
                                    echo '<tr><td colspan="7" class="text-center">No blog posts added yet.</td></tr>';
                                } else {
                                    foreach ($posts as $post) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($post['id']) . '</td>';
                                        echo '<td>' . htmlspecialchars($post['title']) . '</td>';
                                        echo '<td>' . htmlspecialchars($post['slug']) . '</td>';
                                        echo '<td>' . htmlspecialchars($post['author_username'] ?? 'N/A') . '</td>';
                                        echo '<td><span class="badge ' . ($post['status'] == 'published' ? 'bg-success' : 'bg-secondary') . '">' . htmlspecialchars(ucfirst($post['status'])) . '</span></td>';
                                        echo '<td>' . htmlspecialchars($post['created_at']) . '</td>';
                                        echo '<td>';
                                        echo '<button type="button" class="btn btn-warning btn-sm me-2 edit-post-btn rounded-md" data-id="' . $post['id'] . '" data-bs-toggle="modal" data-bs-target="#addEditPostModal">Edit</button>';
                                        echo '<a href="manage_blog_posts.php?action=delete&id=' . $post['id'] . '" class="btn btn-danger btn-sm rounded-md" onclick="return confirm(\'Are you sure you want to delete this blog post?\');">Delete</a>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            } catch (PDOException $e) {
                                echo '<tr><td colspan="7" class="text-center text-danger">Error loading blog posts: ' . $e->getMessage() . '</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add/Edit Blog Post Modal -->
        <div class="modal fade" id="addEditPostModal" tabindex="-1" aria-labelledby="addEditPostModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content rounded-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEditPostModalLabel">Add/Edit Blog Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="blogPostForm" action="manage_blog_posts.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="post_id" id="post_id">
                            <div class="mb-3">
                                <label for="title" class="form-label">Post Title</label>
                                <input type="text" class="form-control rounded-md" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content (HTML allowed)</label>
                                <textarea class="form-control rounded-md" id="content" name="content" rows="10" required></textarea>
                                <small class="form-text text-muted">You can use basic HTML tags for formatting (e.g., &lt;p&gt;, &lt;h1&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;).</small>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select rounded-md" id="status" name="status" required>
                                    <option value="draft">Draft</option>
                                    <option value="published">Published</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-md" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit_post" class="btn btn-primary rounded-md">Save Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Reset form when modal is hidden
            $('#addEditPostModal').on('hidden.bs.modal', function () {
                $('#blogPostForm')[0].reset();
                $('#post_id').val('');
                $('#addEditPostModalLabel').text('Add New Blog Post');
            });

            // Populate form when edit button is clicked
            $('.edit-post-btn').on('click', function() {
                var postId = $(this).data('id');
                $('#addEditPostModalLabel').text('Edit Blog Post');

                // Fetch post data via AJAX
                $.ajax({
                    url: 'fetch_blog_post_data.php', // A new PHP file to fetch single post data
                    type: 'GET',
                    data: { id: postId },
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            $('#post_id').val(data.id);
                            $('#title').val(data.title);
                            $('#content').val(data.content);
                            $('#status').val(data.status);
                        } else {
                            alert('Error: Blog post data not found.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('AJAX Error: ' + status + ' - ' + error + '\nResponse: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>