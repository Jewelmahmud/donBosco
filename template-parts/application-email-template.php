<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Job Application</title>
  <style>
    .container {
        width: 90%;
        margin: 0 auto;
    }
    .title {
        text-align: center;
        font-weight: bold;
    }
    table {
        width: 100%;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }
  </style>
</head>
<body>
<div class="container">
    <h2 class="title">New Job Application Submitted on "<?php echo esc_html(sanitizeInput($post['title'])); ?>"</h2>

    <table>
        <tr>
            <td><strong>First Name:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['firstname'])); ?></td>
        </tr>
        <tr>
            <td><strong>Last Name:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['lastname'])); ?></td>
        </tr>
        <tr>
            <td><strong>Date of birth:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['dob'])); ?></td>
        </tr>
        <tr>
            <td><strong>Phone:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['phone'], 'int')); ?></td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['email'], 'email')); ?></td>
        </tr>
        <tr>
            <td><strong>Place:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['place'])); ?></td>
        </tr>
        <tr>
            <td><strong>Do you speak English:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['speakEnglish'])); ?></td>
        </tr>
        <tr>
            <td><strong>Do you have a driving license:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['drivingLicense'])); ?></td>
        </tr>
        <tr>
            <td><strong>Have you worked in the Netherlands before:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['workedInNetherlands'])); ?></td>
        </tr>
        <tr>
            <td><strong>Are you currently staying in the Netherlands:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['stayingInNetherlands'])); ?></td>
        </tr>
        <tr>
            <td><strong>Accommodation:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['accommodation'])); ?></td>
        </tr>
        <tr>
            <td><strong>Proven Experience:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['provenExperience'])); ?></td>
        </tr>
        <tr>
            <td><strong>Comment:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['textArea'], 'textarea')); ?></td>
        </tr>
        <tr>
            <td><strong>Job reference No:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['referrence'], 'text')); ?></td>
        </tr>
        <tr>
            <td><strong>Permission of Data use:</strong></td>
            <td><?php echo esc_html(sanitizeInput($post['datapermission'], 'text')); ?></td>
        </tr>
    </table>

    <p><strong>Attachment:</strong> <a href="<?php echo esc_url($_FILES['file']['tmp_name']); ?>" download><?php echo esc_html(sanitizeInput($_FILES['file']['name'])); ?></a></p>
</div>

</body>
</html>

