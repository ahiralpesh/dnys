<!-- admin/manage_pages.php - Admin: Manage Static Pages -->
<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Static Pages - Admin Panel</title>
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
        <h2 class="text-center mb-4">Manage Static Pages</h2>

        <?php
        // admin/manage_pages.php - PHP backend for static page management
        

        if (!isLoggedIn() || !isAdmin()) {
            redirect('../login.php');
        }

        $message = '';
        $message_type = '';

        // Handle Update Page
        if (isset($_POST['submit_page'])) {
            $page_id = (int)$_POST['page_id'];
            $title = sanitizeInput($_POST['title']);
            $content = $_POST['content']; // HTML content, don't sanitize with htmlspecialchars

            if (empty($title) || empty($content)) {
                $message = 'Title and content are required.';
                $message_type = 'danger';
            } else {
                try {
                    $stmt = $pdo->prepare("UPDATE static_pages SET title = ?, content = ? WHERE id = ?");
                    $stmt->execute([$title, $content, $page_id]);
                    $message = 'Page updated successfully!';
                    $message_type = 'success';
                } catch (PDOException $e) {
                    $message = 'Error updating page: ' . $e->getMessage();
                    $message_type = 'danger';
                }
            }
        }
        ?>

        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?> rounded-lg" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <!-- Static Page List -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">Existing Static Pages</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Last Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $stmt = $pdo->query("SELECT id, title, slug, last_updated_at FROM static_pages ORDER BY title ASC");
                                $pages = $stmt->fetchAll();

                                if (empty($pages)) {
                                    echo '<tr><td colspan="5" class="text-center">No static pages found.</td></tr>';
                                } else {
                                    foreach ($pages as $page) {
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($page['id']) . '</td>';
                                        echo '<td>' . htmlspecialchars($page['title']) . '</td>';
                                        echo '<td>' . htmlspecialchars($page['slug']) . '</td>';
                                        echo '<td>' . htmlspecialchars($page['last_updated_at']) . '</td>';
                                        echo '<td>';
                                        echo '<button type="button" class="btn btn-warning btn-sm me-2 edit-page-btn rounded-md" data-id="' . $page['id'] . '" data-bs-toggle="modal" data-bs-target="#editPageModal">Edit</button>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                }
                            } catch (PDOException $e) {
                                echo '<tr><td colspan="5" class="text-center text-danger">Error loading static pages: ' . $e->getMessage() . '</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Edit Page Modal -->
        <div class="modal fade" id="editPageModal" tabindex="-1" aria-labelledby="editPageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content rounded-lg">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPageModalLabel">Edit Static Page Content</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="staticPageForm" action="manage_pages.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="page_id" id="page_id">
                            <div class="mb-3">
                                <label for="page_title" class="form-label">Page Title</label>
                                <input type="text" class="form-control rounded-md" id="page_title" name="title" readonly> <!-- Title is readonly as it's fixed by slug -->
                            </div>
                            <div class="mb-3">
                                <label for="page_content" class="form-label">Page Content (HTML allowed)</label>
                                <textarea class="form-control rounded-md" id="page_content" name="content" rows="15" required></textarea>
                                <small class="form-text text-muted">You can use basic HTML tags for rich formatting (e.g., &lt;p&gt;, &lt;h1&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;, &lt;br&gt;).</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-md" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit_page" class="btn btn-primary rounded-md">Save Changes</button>
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
            $('#editPageModal').on('hidden.bs.modal', function () {
                $('#staticPageForm')[0].reset();
                $('#page_id').val('');
            });

            // Populate form when edit button is clicked
            $('.edit-page-btn').on('click', function() {
                var pageId = $(this).data('id');

                // Fetch page data via AJAX
                $.ajax({
                    url: 'fetch_page_data.php', // A new PHP file to fetch single page data
                    type: 'GET',
                    data: { id: pageId },
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            $('#page_id').val(data.id);
                            $('#page_title').val(data.title);
                            $('#page_content').val(data.content);
                        } else {
                            alert('Error: Page data not found.');
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