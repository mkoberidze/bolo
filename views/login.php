<form method="POST" action="/login" novalidate>
            <label for="username" class="center">Email</label>
            <input type="text" class="form-control <?php echo isset($errors['username']) ? ' is-invalid' : '' ?>"
                   value="<?php if(isset($_SESSION['username'])) echo $_SESSION['username']; else echo "";  ?>" name="username">
            <div class="invalid-feedback">
                <?php echo $errors['username'] ?? '' ?>
            </div>


            <label for="userpassword" class="center">Password</label>
            <input type="password" class="form-control <?php echo isset($errors['userpassword']) ? ' is-invalid' : '' ?>"
                   value="<?php if(isset($_SESSION['userpassword'])) echo $_SESSION['userpassword']; else echo "";  ?>" name="userpassword">
            <div class="invalid-feedback">
                <?php echo $errors['userpassword'] ?? '' ?>
            </div>
        <button type="submit" class="btn btn-primary md-5 ml-1 logon" name="loginbtn">Log In</button>

</form>