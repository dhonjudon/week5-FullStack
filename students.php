<?php
require_once 'functions.php';
include 'header.php';

$students = [];
$filePath = __DIR__ . '/students.txt';

if (file_exists($filePath)) {
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $parts = explode('|', $line);
        if (count($parts) >= 3) {
            $students[] = [
                'name' => $parts[0],
                'email' => $parts[1],
                'skills' => explode(',', $parts[2])
            ];
        }
    }
}
?>
<main class="page">
    <h2>Students</h2>
    <?php if (empty($students)): ?>
        <p>No students saved yet.</p>
    <?php else: ?>
        <div class="card-grid">
            <?php foreach ($students as $student): ?>
                <article class="card">
                    <h3><?php echo htmlspecialchars($student['name']); ?></h3>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email']); ?></p>
                    <p><strong>Skills:</strong></p>
                    <ul>
                        <?php foreach ($student['skills'] as $skill): ?>
                            <li><?php echo htmlspecialchars($skill); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
<?php include 'footer.php'; ?>