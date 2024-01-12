<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Preview Example</title>
    <style>
        /* Add some basic styling for demonstration purposes */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #image-preview {
            max-width: 300px;
            max-height: 300px;
            margin: 10px 0;
        }
    </style>
</head>
<body>

    <form action="#" method="post" enctype="multipart/form-data">
        <label for="file-input">Choose File:</label>
        <input type="file" id="file-input" name="file" accept="image/*" onchange="previewImage()">

        <!-- Image preview container -->
        <div id="image-preview"></div>
    </form>

    <script>
        function previewImage() {
            var fileInput = document.getElementById('file-input');
            var imagePreview = document.getElementById('image-preview');

            // Clear any previous preview
            imagePreview.innerHTML = '';

            // Check if a file is selected
            if (fileInput.files.length > 0) {
                var file = fileInput.files[0];

                // Check if the file is an image
                if (file.type.match(/^image\//)) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        // Create an image element and set its source to the preview URL
                        var img = document.createElement('img');
                        img.src = e.target.result;

                        // Append the image to the preview container
                        imagePreview.appendChild(img);
                    };

                    // Read the file as a data URL
                    reader.readAsDataURL(file);
                } else {
                    // Display an error message if the selected file is not an image
                    imagePreview.innerHTML = '<p>Selected file is not an image.</p>';
                }
            }
        }
    </script>

</body>
</html>
