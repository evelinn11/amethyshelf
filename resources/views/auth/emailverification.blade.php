<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AmethyShelf - Email Verification</title>
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
      width: 85%;
      max-width: 1100px;
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
    .input-icon-group input {
      padding-left: 40px;
      border-radius: 25px;
      height: 50px;
      border: 2px solid #ccc;
    }
    .btn-custom {
      border-radius: 25px;
      padding: 10px 0;
      font-weight: 600;
      background-color: white;
      border: 2px solid black;
      width: 100%;
    }
    .left-section {
      text-align: center;
      flex: 1 1 300px;
    }
    .right-section {
      flex: 1 1 400px;
    }
    @media (max-width: 768px) {
      .card-custom {
        flex-direction: column;
        align-items: center;
      }
      .right-section {
        margin-top: 30px;
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <div class="card-custom">
    <!-- Left Section -->
    <div class="left-section">
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

    <!-- Right Section -->
    <div class="right-section form-section">
      <h4 class="mb-4 text-center fw-bold">Email Verification</h4>
        <form action="{{ route('emailverification.verify') }}" method="POST">
            @csrf
            <div class="input-icon-group">
                <i class="fa-regular fa-envelope input-icon-left"></i>
                <input type="email" class="form-control" placeholder="Email" name="email" required />
            </div>
            <button class="btn btn-custom mb-3" type="submit">Send Verification</button>
        </form>      
        <div class="text-center text-small mt-2">
        Remember your password? <a href="{{ route('signin.show') }}">Sign in</a>
      </div>
    </div>
  </div>
</body>
</html>