<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SeaTrack - Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/login.css"
    
</head>
<body>
    <div class="main-container">
        <div class="auth-wrapper">
            <!-- Left Banner -->
            <div class="auth-banner">
                <div class="wave-decoration"></div>
                <div class="wave-decoration"></div>
                <div class="wave-decoration"></div>
                
                <div class="logo-container">
                    <div class="logo">Sea<span class="track">Track</span></div>
                </div>
                
                <div class="banner-content">
                    <h1>Fishing Boat Registration System</h1>
                    <p>A comprehensive solution for registering and managing fishing boats.</p>
                    
                    <div class="feature-list">
                        <div class="feature-item">
                            <i class="fas fa-ship"></i>
                            <div>Seamless Boat Registration</div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-chart-line"></i>
                            <div>Owner & Vessel Record Management</div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-clipboard-check"></i>
                            <div>Automated Renewal & Compliance Tracking</div>
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-bell"></i>
                            <div>Detailed Analytics & Reports</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Forms Container -->
            <div class="auth-forms">
                <!-- Login Form -->
                <div id="loginForm">
                    <div class="auth-header">
                        <h2>Welcome Back</h2>
                        <p>Log in to your SeaTrack account</p>
                    </div>
                    
                    <div class="social-login">
                        <a href="#" class="social-btn google">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-btn apple">
                            <i class="fab fa-apple"></i>
                        </a>
                    </div>
                    
                    <div class="form-divider">
                        <span>or login with email</span>
                    </div>
                    
                    <form action="login_process.php" method="post">
    <div class="form-floating">
        <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
        <label>Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <label>Password</label>
    </div>
    <button type="submit" class="auth-btn">Log In</button>
</form>

                    <p class="toggle-form" onclick="toggleForms()">Don't have an account? <strong>Sign up</strong></p>
                    
                    <div class="auth-footer">
                        <p>&copy; 2025 SeaTrack. All rights reserved.</p>
                    </div>
                </div>
                
                <!-- Signup Form -->
                <div id="signupForm" class="hidden">
                    <div class="auth-header">
                        <h2>Create Account</h2>
                        <p>Join SeaTrack to manage your fleet</p>
                    </div>
                    
                    <form action="signup_process.php" method="post">
    <div class="form-floating">
        <input type="text" class="form-control" name="fullName" placeholder="Full Name" required>
        <label>Full Name</label>
    </div>
    <div class="form-floating">
        <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
        <label>Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <label>Password</label>
    </div>
    <button type="submit" class="auth-btn">Create Account</button>
</form>

                    <p class="toggle-form" onclick="toggleForms()">Already have an account? <strong>Log in</strong></p>
                    
                    <div class="auth-footer">
                        <p>&copy; 2025 SeaTrack. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleForms() {
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            
            if (loginForm.classList.contains('hidden')) {
                loginForm.classList.remove('hidden');
                signupForm.classList.add('hidden');
            } else {
                loginForm.classList.add('hidden');
                signupForm.classList.remove('hidden');
            }
        }
        
        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const signupForm = document.querySelector('#signupForm form');
            if (signupForm) {
                signupForm.addEventListener('submit', function(e) {
                    const password = document.getElementById('signupPassword').value;
                    const confirmPassword = document.getElementById('confirmPassword').value;
                    
                    if (password !== confirmPassword) {
                        e.preventDefault();
                        // Check if error message already exists
                        let errorMsg = document.querySelector('.error-message');
                        if (!errorMsg) {
                            errorMsg = document.createElement('p');
                            errorMsg.classList.add('error-message');
                            errorMsg.textContent = 'Passwords do not match';
                            document.getElementById('confirmPassword').parentNode.insertAdjacentElement('afterend', errorMsg);
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>