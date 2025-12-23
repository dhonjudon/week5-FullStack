<?php
require_once 'functions.php';
include 'header.php';

$name = '';
$email = '';
$skillsInput = '';
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = formatName($_POST['name'] ?? '');
        $email = validateEmail($_POST['email'] ?? '');
        $skillsInput = trim($_POST['skills'] ?? '');
        $skillsArray = cleanSkills($skillsInput);

        if ($name === '' || $skillsInput === '') {
            throw new Exception('Please fill in all fields.');
        }

        saveStudent($name, $email, $skillsArray);
        $message = 'Student saved successfully!';
        $skillsInput = '';
        $name = '';
        $email = '';
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<main class="page">
    <h2>Add Student Info</h2>
    <?php if ($message): ?>
        <div class="alert success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
        <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" class="card">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="skills">Skills (comma separated)</label>
        <input type="text" id="skills" name="skills" value="<?php echo htmlspecialchars($skillsInput); ?>"
            placeholder="HTML, CSS, PHP" required>

        <button type="submit" class="btn">Save Student</button>
    </form>
</main>
<?php include 'footer.php'; ?>