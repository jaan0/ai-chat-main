<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Signup | Gemini AI</title>
</head>
<body>
    <?php
     include 'nav.html'; 
    ?>
    <div class="container">
        <h2 class="mt-5 text-primary">Sign Up</h2>
    <form class="col-sm-10 mx-auto">
        <div class="mt-5 row ">
            <label for="inputEmail" class="col-sm-1 col-form-label text-primary">Email</label>
            <div class="col-sm-5">
                <input type="email" class="form-control" id="inputEmail" placeholder="email@example.com" >
            </div>
        </div>
        <div class="mt-5 row">
            <label for="inputPassword" class="col-sm-1 col-form-label text-primary">Password</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="inputPassword" placeholder="enter your password...">
            </div>
            <div class="mt-5 row">
                <div class="col-sm-10 offset-sm-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</body>
</html>