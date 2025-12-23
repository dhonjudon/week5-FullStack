<?php
// Basic helper functions for the student portfolio manager

function formatName($name)
{
    $name = trim($name);
    $name = strtolower($name);
    return ucwords($name);
}

function validateEmail($email)
{
    $email = trim($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email format.');
    }
    return $email;
}

function cleanSkills($string)
{
    $parts = explode(',', $string);
    $skills = [];
    foreach ($parts as $skill) {
        $skill = trim($skill);
        if ($skill !== '') {
            $skills[] = $skill;
        }
    }
    return $skills;
}

function saveStudent($name, $email, $skillsArray)
{
    $filePath = __DIR__ . '/students.txt';
    $skillsString = implode(',', $skillsArray);
    $line = $name . '|' . $email . '|' . $skillsString . PHP_EOL;

    $file = @fopen($filePath, 'a');
    if (!$file) {
        throw new Exception('Could not open students.txt for writing.');
    }

    if (fwrite($file, $line) === false) {
        fclose($file);
        throw new Exception('Failed to write student data.');
    }

    fclose($file);
    return true;
}

function uploadPortfolioFile($file)
{
    if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        throw new Exception('No file was uploaded.');
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('Upload error code: ' . $file['error']);
    }

    $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
    $maxSize = 2 * 1024 * 1024; // 2MB

    if ($file['size'] > $maxSize) {
        throw new Exception('File too big. Max size is 2MB.');
    }

    $originalName = $file['name'];
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedTypes)) {
        throw new Exception('Invalid file type. Allowed: PDF, JPG, PNG.');
    }

    $base = pathinfo($originalName, PATHINFO_FILENAME);
    $base = strtolower(trim($base));
    $base = str_replace(' ', '_', $base);
    $safeName = $base . '_' . time() . '.' . $ext;

    $uploadDir = __DIR__ . '/uploads';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            throw new Exception('Could not create uploads directory.');
        }
    }

    $target = $uploadDir . '/' . $safeName;
    if (!move_uploaded_file($file['tmp_name'], $target)) {
        throw new Exception('Could not move uploaded file.');
    }

    return $safeName;
}
?>