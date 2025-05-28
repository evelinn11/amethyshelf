<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AmethyShelf - Sign In</title>
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
  />
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
    }

    .logo {
      font-weight: 800;
      font-size: 28px;
    }

    .form-control {
      border-radius: 25px;
      padding: 10px 20px;
    }

    .input-group-text {
      background-color: white;
      border: none;
    }

    .btn-custom {
      border-radius: 25px;
      padding: 10px 0;
      font-weight: 600;
      background-color: white;
      border: 2px solid black;
    }

    .social-icons i {
      font-size: 20px;
      margin: 0 8px;
    }

    .logo-img {
      font-size: 60px;
    }

    .text-small {
      font-size: 14px;
      font-style: italic;
    }

    .form-section {
      max-width: 400px;
    }

    .icon-eye {
      cursor: pointer;
    }

    /* Tambahan untuk input dengan ikon di dalam */
    .input-icon-group {
      position: relative;
      margin-bottom: 1rem;
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

    <div class="form-section">
      <h4 class="mb-4 text-center fw-bold">Sign In</h4>
      <form action="{{ route('signin.auth') }}" method="POST" novalidate>
        @csrf
        <div class="input-icon-group mb-3">
          <i class="fa-regular fa-envelope input-icon-left"></i>
          <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
            autofocus
            placeholder="Email"
          >
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="input-icon-group mb-3">
          <i class="fa-solid fa-lock input-icon-left"></i>
          <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            id="passwordInput"
            name="password"
            required
            placeholder="Password"
          >
          <i class="fa-regular fa-eye input-icon-right" id="togglePassword"></i>
          @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3 text-end text-small">
          <a href="{{ route('emailverification.show') }}" style="color: inherit; text-decoration: none;">Forget Password?</a>
        </div>
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-custom w-100 mb-3">Sign In</button>
        </div>
      </form>
      <div class="text-center text-small mb-2">New to Amethyshelf?</div>
      <button class="btn btn-custom w-100" onclick="window.location.href='{{ route('signup.show') }}'" type="button">Sign Up</button>
    </div>
  </div>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const eyeIcon = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('passwordInput');
      eyeIcon.addEventListener('click', function() {
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          eyeIcon.classList.remove('fa-eye');
          eyeIcon.classList.add('fa-eye-slash');
        } else {
          passwordInput.type = 'password';
          eyeIcon.classList.remove('fa-eye-slash');
          eyeIcon.classList.add('fa-eye');
        }
      });
    });
  </script>
</body>
</html>
