<?php include 'header.php'; ?>
<main class="page">
    <h2>Welcome</h2>
    <p>This tiny site lets you practice basic PHP skills: forms, string handling, files, includes, and uploads.</p>
    <section class="card-grid">
        <article class="card">
            <h3>Add Student Info</h3>
            <p>Save a name, email, and skills into a text file.</p>
            <a class="btn" href="add_student.php">Go to form</a>
        </article>
        <article class="card">
            <h3>Upload Portfolio File</h3>
            <p>Upload a PDF/JPG/PNG portfolio file (max 2MB) into the uploads folder.</p>
            <a class="btn" href="upload.php">Upload now</a>
        </article>
        <article class="card">
            <h3>View Students</h3>
            <p>See the students saved in students.txt with their skills shown as an array.</p>
            <a class="btn" href="students.php">View list</a>
        </article>
    </section>
</main>
<?php include 'footer.php'; ?>