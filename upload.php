<?php
require_once 'functions.php';
include 'header.php';

$message = '';
$error = '';
$uploadedName = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $uploadedName = uploadPortfolioFile($_FILES['portfolio']);
        $message = 'File uploaded as: ' . $uploadedName;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<main class="page">
    <h2>Upload Portfolio File</h2>
    <?php if ($message): ?>
        <div class="alert success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="card">
        <label for="portfolio">Choose PDF/JPG/PNG (max 2MB)</label>
        <input type="file" id="portfolio" name="portfolio" accept=".pdf,.jpg,.jpeg,.png" required>
        <button type="submit" class="btn">Upload</button>
    </form>
</main>
<?php include 'footer.php'; ?>