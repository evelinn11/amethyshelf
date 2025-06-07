<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AmethyShelf - Admin Sign Up</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background: linear-gradient(to bottom, #f9f6ff, #3d1c5c);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card-custom {
      width: 80%;
      max-width: 1000px;
      border: 4px solid #f7c9ff;
      border-radius: 30px;
      padding: 50px;
      background-color: white;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
    }
    .logo {
      font-weight: 800;
      font-size: 28px;
    }
    .logo-img {
      font-size: 60px;
    }
    .social-icons i {
      font-size: 20px;
      margin: 0 8px;
    }
    .text-small {
      font-size: 14px;
      font-style: italic;
    }
    .form-section {
      max-width: 400px;
    }
    .input-icon-group {
      position: relative;
      margin-bottom: 1.5rem;
    }
    .input-icon-group .input-icon-left {
      position: absolute;
      left: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #aaa;
      font-size: 1rem;
      z-index: 2;
    }
    .input-icon-group .input-icon-right {
      position: absolute;
      right: 16px;
      top: 50%;
      transform: translateY(-50%);
      color: #aaa;
      font-size: 1rem;
      cursor: pointer;
      z-index: 2;
    }
    .input-icon-group input {
      padding-left: 40px;
      padding-right: 40px;
      border-radius: 25px;
    }
    .form-control {
      border-radius: 25px;
      padding: 10px 20px;
    }
    .btn-custom {
      border-radius: 25px;
      padding: 10px 0;
      font-weight: 600;
      background-color: white;
      border: 2px solid black;
      width: 100%;
    }
    .error-placeholder {
      min-height: 24px;
    }
  </style>
</head>
<body>
  <div class="card-custom d-flex justify-content-between flex-wrap flex-md-nowrap">
    <div class="text-center flex-grow-1 mb-4 mb-md-0">
      <div class="logo mb-4">AMETHYSHELF</div>
      <div class="logo-img mb-3">
      <i class="fa-solid fa-book-open"></i>
      </div>
      <div class="social-icons mb-3">
        <i class="fab fa-instagram"></i>
        <i class="fab fa-youtube"></i>
        <i class="fab fa-twitter"></i>
        <i class="fab fa-linkedin"></i>
      </div>
      <div class="fw-semibold">@ 2025 AMETHYSHELF BY GROUP 1</div>
    </div>
    <form action="{{ route('admin.signup.submit') }}" method="POST" class="form-section">
      @csrf
      <h4 class="mb-4 text-center fw-bold">Admin Sign Up</h4>
      <div class="input-icon-group mb-3">
        <i class="fa-regular fa-user input-icon-left"></i>
        <input type="text" class="form-control" placeholder="Full Name" name="name" value="{{ old('name') }}" required />
      </div>
      <div class="input-icon-group mb-3">
        <i class="fa-regular fa-envelope input-icon-left"></i>
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required />
      </div>
      <div class="input-icon-group mb-3">
        <i class="fa-solid fa-lock input-icon-left"></i>
        <input type="password" class="form-control" placeholder="Password" id="passwordInput1" name="password" required />
        <i class="fa-regular fa-eye input-icon-right" id="togglePassword1"></i>
      </div>
      <div class="input-icon-group mb-3">
        <i class="fa-solid fa-lock input-icon-left"></i>
        <input type="password" class="form-control" placeholder="Repeat Password" id="passwordInput2" name="repeat_password" required />
        <i class="fa-regular fa-eye input-icon-right" id="togglePassword2"></i>
        @error('repeat_password')
          <span class="text-danger mt-1 position-absolute" style="left:0;top:100%;font-size:14px;">
            Password and Repeat Password must same
          </span>
        @enderror
      </div>
      <button class="btn btn-custom w-100 mb-3" type="submit">Sign Up as Admin</button>
      <div class="text-center text-small mb-2">Already sign in? <a href="{{ route('signin.show') }}">Sign in</a></div>
    </form>
  </div>
  <script>
    function setupPasswordToggle(inputId, toggleId) {
      const input = document.getElementById(inputId);
      const toggle = document.getElementById(toggleId);
      toggle.addEventListener('click', () => {
        if (input.type === 'password') {
          input.type = 'text';
          toggle.classList.remove('fa-eye');
          toggle.classList.add('fa-eye-slash');
        } else {
          input.type = 'password';
          toggle.classList.remove('fa-eye-slash');
          toggle.classList.add('fa-eye');
        }
      });
    }
    document.addEventListener('DOMContentLoaded', function () {
      setupPasswordToggle('passwordInput1', 'togglePassword1');
      setupPasswordToggle('passwordInput2', 'togglePassword2');
    });
  </script>
</body>
</html>
