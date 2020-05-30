<?php
$params = $params ?? [];
$errors = $errors ?? [];
$data    = $data ?? [];

?>

<h1>Contact Page</h1>

<form method="post" action="/contact">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control <?php echo isset($errors['email']) ? ' is-invalid' : '' ?>"
               id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <div class="invalid-feedback">
            <?php echo $errors['username'] ?? '' ?>
        </div>

    </div>


    <button type="submit" class="btn btn-primary">Submit</button>
</form>


