<html>
    <head>
        <title>PHP | Upload binary files to a directory and store target file path in MySQL</title>
        <meta charset="UTF-8">
        <meta name="description" content="Example of upload and store image file in database and server using PHP and MySQL">
        <meta name="keywords" content="PHP, MySQL, Upload, Store">
        <meta name="author" content="JORGE LUIS AGUIRRE MARTINEZ">
        <meta name="publish_date" property="og:publish_date" content="2023-03-15T17:00:00-0600">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .image-gallery {
                text-align:center;
            }
            .image-gallery img {
                padding: 3px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
                border: 1px solid #FFFFFF;
                border-radius: 4px;
                margin: 20px;
            }
        </style>
    </head>
    <body>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select Image File to Upload:
            <input type="file" name="file">
            <input type="submit" name="submit" value="Upload">
        </form>
        <div class="image-gallery">
            <?php require_once __DIR__ . '/viewImages.php'; ?>
        </div>
    </body>
</html>