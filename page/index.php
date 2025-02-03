
<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src = "/js/script.js" defer></script>
        <title>Item Management System</title>
    </head>

    <body>
        <?php include 'header.php'; ?>
        <main>

            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (!isset($_SESSION['user'])): ?>
                            <h1>Welcome to the Item Management System</h1>
                            <p>Please Login or Register to proceed on using the system.</p>
                        <?php else: ?>
                            <h1>Welcome <?php echo $_SESSION['username']; ?>!</h1>
                            <p>Manage your item easily with us.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
        
        <!-- login and register form -->
        <div class="blur-bg-overlay">
            <div class="form-popup">
                <span class="close-btn material-symbols-rounded" style="color:black">Close</span>
                <div class="form-wrap">

                    <div class="form-box login">
                        <div class="form-content">
                            <h2>LOGIN</h2>
                            <form action="user/login.php" id="login-form" method="POST">
                                <div class="input-field">
                                    <input type="text" name="username" id="username" required>
                                    <label>Username</label>
                                </div>
                                <div class="input-field">
                                    <input type="password" name="password" id="password" required>
                                    <label>Password</label>
                                    <button type="button" class="toggle-password" data-target="#password">
                                        <img src="/img/hidden.png" style="height: 20px; width: 20px;" alt="show password" class="toggle-icon">
                                    </button>
                                </div>
                                <button type="submit" class="button">Login</button>
                            </form>
                            <div class="bottom-link">
                                <a href="#" id="register-link">Don't have an account? Register here</a>
                            </div>
                        </div>
                    </div>

                    <div class="form-box register">
                        <div class="form-content">
                            <h2>REGISTER</h2>
                            <form action="/page/user/register.php" id="register-form" method="POST">
                                <div class="input-field">
                                    <input type="text" name="usernameReg" id="usernameReg"  required>
                                    <label>Username</label>
                                </div>
                                <div class="input-field">
                                    <input type="password" name="passwordReg" id="passwordReg"  required>
                                    <label>Password</label>
                                    <button type="button" class="toggle-password" data-target="#passwordReg">
                                        <img src="/img/hidden.png" style="height: 20px; width: 20px;" alt="show password" class="toggle-icon">
                                    </button>
                                </div>
                                <div class="input-field">
                                    <input type="password" name="confirm-password" id="confirm-password" required>
                                    <label>Confirm Password</label>
                                    <button type="button" class="toggle-password" data-target="#confirm-password">
                                        <img src="/img/hidden.png" style="height: 20px; width: 20px;" alt="show password" class="toggle-icon">
                                    </button>
                                </div>
                                <button type="submit" class="button">Register</button>
                            </form>
                            <div class="bottom-link">
                                <a href="#" id="login-link">Already have an account? Login here</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
    
</html>