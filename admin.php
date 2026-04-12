<?php
session_start();
include 'php-txt/basetext.php';
include 'php-xampp/db.php';
include 'php-xampp/admin-auth.php';

if (!is_admin_logged_in()) {
    header('Location: login.php');
    exit;
}

$feedback_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_id'])) {
    $reply_id = (int) $_POST['reply_id'];
    $reply_text = trim($_POST['reply_text'] ?? '');

    $reply_statement = $db->prepare('UPDATE contact_messages SET reply = ? WHERE id = ?');
    $reply_statement->bind_param('si', $reply_text, $reply_id);
    $reply_statement->execute();
    $reply_statement->close();

    header('Location: admin.php?replied=1');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int) $_POST['delete_id'];
    $delete_statement = $db->prepare('DELETE FROM contact_messages WHERE id = ?');
    $delete_statement->bind_param('i', $delete_id);
    $delete_statement->execute();
    $delete_statement->close();

    header('Location: admin.php?deleted=1');
    exit;
}

if (isset($_GET['deleted'])) {
    $feedback_message = 'Record deleted successfully.';
}

if (isset($_GET['replied'])) {
    $feedback_message = 'Reply saved successfully.';
}

$messages = $db->query('SELECT id, name, email, message, reply, created_at FROM contact_messages ORDER BY created_at DESC');

$admin_header_title = 'Contact Records';
$admin_header_subtitle = 'View, reply, and delete messages submitted through the contact form.';
$back_to_contact_label = 'Back to Contact';
$logout_label = 'Logout';

$th_id = 'ID';
$th_name = 'Name';
$th_email = 'Email';
$th_submitted = 'Submitted';
$th_actions = 'Actions';

$btn_reply = 'Reply';
$btn_view = 'View';
$btn_delete = 'Delete';

$label_message = 'Message:';
$label_reply = 'Reply:';
$no_records_msg = 'No contact records yet.';

$modal_title = 'Reply to contact message';
$modal_label_reply = 'Reply';
$modal_btn_cancel = 'Cancel';
$modal_btn_save = 'Save Reply';
$confirm_delete_msg = 'Delete this record?';
?>
<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <title>Contact Records</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/base-style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <main id="main-content">
        <nav class="site-navbar position-sticky top-0 navbar navbar-expand-sm navbar-dark ps-5 pe-3"
            style="background-color: #262729;">
            <a class="navbar-brand me-5" href="index.php#top"><?php echo $nav_brand; ?></a>
            <div class="ms-auto pe-4 d-flex gap-2">
                <a class="btn btn-outline-light btn-sm" href="contact.php"><?php echo $back_to_contact_label; ?></a>
                <a class="btn btn-outline-danger btn-sm" href="logout.php"><?php echo $logout_label; ?></a>
            </div>
        </nav>

        <section class="container py-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1 text-light"><?php echo $admin_header_title; ?></h1>
                    <p class="text-secondary mb-0"><?php echo $admin_header_subtitle; ?></p>
                </div>
            </div>

            <?php if ($feedback_message !== ''): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($feedback_message); ?></div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle">
                    <thead>
                        <tr>
                            <th><?php echo $th_id; ?></th>
                            <th><?php echo $th_name; ?></th>
                            <th><?php echo $th_email; ?></th>
                            <th><?php echo $th_submitted; ?></th>
                            <th class="text-end"><?php echo $th_actions; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($messages && $messages->num_rows > 0): ?>
                            <?php while ($row = $messages->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo (int) $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-info" type="button" data-bs-toggle="modal"
                                            data-bs-target="#replyModal" data-reply-id="<?php echo (int) $row['id']; ?>"
                                            data-reply-name="<?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>"
                                            data-reply-email="<?php echo htmlspecialchars($row['email'], ENT_QUOTES); ?>"
                                            data-reply-text="<?php echo htmlspecialchars($row['reply'] ?? '', ENT_QUOTES); ?>">
                                            <?php echo $btn_reply; ?>
                                        </button>
                                        <button class="btn btn-sm btn-outline-light" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#message-<?php echo (int) $row['id']; ?>"><?php echo $btn_view; ?></button>
                                        <form method="post" action="admin.php" class="d-inline"
                                            onsubmit="return confirm('<?php echo $confirm_delete_msg; ?>');">
                                            <input type="hidden" name="delete_id" value="<?php echo (int) $row['id']; ?>" />
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger"><?php echo $btn_delete; ?></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="p-0 border-0">
                                        <div class="collapse" id="message-<?php echo (int) $row['id']; ?>">
                                            <div class="p-3 bg-secondary text-light">
                                                <strong><?php echo $label_message; ?></strong>
                                                <p class="mb-0 mt-2"><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                                                <?php if (!empty($row['reply'])): ?>
                                                    <hr class="border-light opacity-25" />
                                                    <strong><?php echo $label_reply; ?></strong>
                                                    <p class="mb-0 mt-2"><?php echo nl2br(htmlspecialchars($row['reply'])); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-4"><?php echo $no_records_msg; ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content bg-dark text-light">
                        <form method="post" action="admin.php">
                            <div class="modal-header border-secondary">
                                <h5 class="modal-title" id="replyModalLabel"><?php echo $modal_title; ?></h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-secondary mb-3" id="replyRecipient"></p>
                                <input type="hidden" name="reply_id" id="reply_id" value="" />
                                <div class="mb-3">
                                    <label for="reply_text" class="form-label"><?php echo $modal_label_reply; ?></label>
                                    <textarea class="form-control" id="reply_text" name="reply_text" rows="6"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-secondary">
                                <button type="button" class="btn btn-outline-light"
                                    data-bs-dismiss="modal"><?php echo $modal_btn_cancel; ?></button>
                                <button type="submit" class="btn btn-primary"><?php echo $modal_btn_save; ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script>
        const replyModal = document.getElementById('replyModal');
        if (replyModal) {
            replyModal.addEventListener('show.bs.modal', (event) => {
                const button = event.relatedTarget;
                const replyId = button.getAttribute('data-reply-id');
                const replyName = button.getAttribute('data-reply-name');
                const replyEmail = button.getAttribute('data-reply-email');
                const replyText = button.getAttribute('data-reply-text') || '';

                document.getElementById('reply_id').value = replyId;
                document.getElementById('reply_text').value = replyText;
                document.getElementById('replyRecipient').textContent = `Replying to ${replyName} <${replyEmail}>`;
            });
        }
    </script>
</body>

</html>