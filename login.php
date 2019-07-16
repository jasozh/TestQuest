<?php include 'header.php'; ?>

<div class='body'>
    <div class='container'>
        <div class='row'>
            <div class='col-sm-4'></div>
            <div class='col-sm-4'>
                <form method='POST' action='loginHandler.php'>
                    <div class='form-group'>
                        <label>Username:</label>
                        <input type='text' class='form-control' name='username' placeholder='Enter username'>
                    </div>
                    <div class='form-group'>
                        <label>Password:</label>
                        <input type='password' class='form-control' name='password' placeholder='Enter password'>
                    </div>
                    <div class='form-group'>
                        <button type='submit' class='btn btn-primary btn-block'>Login</button>
                        <button type='submit' formaction='forgotpassword.php' class='btn btn-danger btn-block'>Forgot
                            Password</button>
                    </div>
                </form>
                <?php
                if(isset($_SESSION['login_error'])) {
                    echo "<div class='alert alert-danger'>Username or password incorrect.</div>";
                    unset($_SESSION['login_error']);
                }
                ?>
            </div>
            <div class='col-sm-4'></div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>