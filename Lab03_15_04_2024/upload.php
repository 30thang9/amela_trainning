<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="w-75 mx-auto pt-5">
        <form action="upload-handler.php" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="fileToUpload" class="form-label">Choose image</label>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
            </div>
            <div class="mb-3">
                <p class="mb-2">Choose option: </p>
                <div class="form-check">
                    <input type="radio" name="option" id="optionOveride" class="form-check-input" value="o" required>
                    <label for="optionOveride" class="form-check-label">Overide image</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="option" id="optionCreate" class="form-check-input" value="c" required>
                    <label for="optionCreate" class="form-check-label">Create new image</label>
                </div>
            </div>
            <div class="mb-3 form-group">
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>

</body>
</html>
