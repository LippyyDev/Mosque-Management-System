<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Masjid Nurul Falah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        .login-form-side {
            padding: 4rem;
        }
        .login-branding-side {
            background: linear-gradient(135deg, #343a40, #212529);
            color: white;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .login-branding-side .fa-mosque {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
         .login-branding-side h1 {
            font-weight: 700;
            font-size: 2rem;
        }
        .btn-dark {
            background-color: #212529;
            border-color: #212529;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }
        .form-control:focus {
             box-shadow: 0 0 0 0.25rem rgba(33, 37, 41, 0.25);
             border-color: #212529;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card login-card">
            <div class="row g-0">
                <div class="col-lg-6 d-none d-lg-flex login-branding-side">
                    <div>
                        <i class="fas fa-mosque"></i>
                        <h1 class="mb-3">Masjid Nurul Falah</h1>
                        <p>Sistem Informasi Manajemen Masjid</p>
                    </div>
                </div>
                <div class="col-lg-6 login-form-side">
                    <h2 class="mb-1 fw-bold">Selamat Datang!</h2>
                    <p class="text-muted mb-4">Silakan login untuk melanjutkan.</p>

                    <?php if(session()->getFlashdata('error')):?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif;?>

                    <form action="<?= base_url('/auth/login') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

