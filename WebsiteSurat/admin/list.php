<?php
$filePath = 'D:\File Progemer\xammp\htdocs\WebsiteSurat\user\surat-data.json';

// Function to retrieve existing data or return an empty array
function getLetters() {
    global $filePath;
    return json_decode(file_get_contents($filePath), true) ?? [];
}

// Function to save data to the JSON file
function saveLetters($letters) {
    global $filePath;
    file_put_contents($filePath, json_encode($letters, JSON_PRETTY_PRINT));
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have form fields with the names 'nama', 'nim', 'isi', 'status', 'dokumen'
    $newLetter = [
        'nama' => $_POST['nama'],
        'nim' => $_POST['nim'],
        'isi' => $_POST['isi'],
        'status' => $_POST['status'],
        'dokumen' => $_POST['dokumen'],
    ];

    // Get existing letters
    $letters = getLetters();

    // Add the new letter to the list
    $letters[] = $newLetter;

    // Save the updated list
    saveLetters($letters);
}

// Get the updated list of letters
$letters = getLetters();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/bootstrap.min.css" />
   <!-- ... (tambahkan link ke file CSS lainnya) -->
   <title>List Daftar Surat</title>
</head>
<body>

<div class="container mt-5">
   <h2>List Daftar Surat</h2>

   <table class="table table-bordered">
      <thead>
         <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Isi Surat</th>
            <th>Status</th>
            <th>Preview Dokumen</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($letters as $letter): ?>
            <tr>
               <td><?= $letter['nama']; ?></td>
               <td><?= $letter['nim']; ?></td>
               <td><?= $letter['isi']; ?></td>
               <td><?= $letter['status']; ?></td>
               <td>
                  <!-- Menampilkan tautan untuk melihat dokumen -->
                  <a href="preview-document.php?document=<?= base64_encode($letter['dokumen']); ?>" target="_blank">Preview Dokumen</a>
               </td>
            </tr>
         <?php endforeach; ?>
      </tbody>
   </table>
</div>

<script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
