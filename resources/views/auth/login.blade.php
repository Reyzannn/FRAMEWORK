<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login - Simbadag</title>
   <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="gradient-bg">
  <div class="page">
    <div class="container">
      <!-- Left: logo & branding -->
      <section class="logo-section" aria-label="Branding">
        <svg class="logo-icon" width="120" height="120" viewBox="0 0 120 120" aria-hidden="true">
          <path d="M20 60 L60 20 L100 60 L100 100 L20 100 Z"
                fill="currentColor" stroke="rgba(255,255,255,0.18)" stroke-width="2" />
          <g fill="white">
            <rect x="45" y="40" width="4" height="40" />
            <polygon points="52,40 52,44 65,44 52,58 52,62 58,62 70,48 70,44 58,44 58,40" />
            <polygon points="58,62 52,62 52,66 65,66 52,80 58,80 75,66 75,62" />
          </g>
        </svg>

        <h1 class="brand-title">simbadag</h1>
        <p class="brand-sub">PT. RJB</p>
      </section>

      <!-- Right: login form -->
      <section class="form-section" aria-label="Login form">
        <div class="login-card" role="region" aria-labelledby="login-heading">
          <h2 id="login-heading" class="form-title">Masuk ke Akun</h2>

          <form class="form-space" onsubmit="handleLogin(event)" action="{{ route('login') }}" novalidate method="POST">
          @csrf  
          <div class="form-group">
              <label for="username">Username</label>
              <div class="input-wrapper">
                <input id="username" name="username" class="input-field" type="text" placeholder="Masukkan username" />
                <div class="icon-right" aria-hidden="true">
                  <svg class="icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                  </svg>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <div class="input-wrapper">
                <input id="password" name="password" class="input-field" type="password" placeholder="Masukkan password" />
                <button type="button" class="icon-right button-icon" onclick="togglePassword()" aria-label="Tampilkan/Sembunyikan password">
                  <svg id="eye-icon" class="icon" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                  </svg>
                </button>
              </div>
            </div>

            <div class="button-row">
              <button type="submit" id="login-button" class="login-btn" aria-live="polite">
                <svg class="btn-icon" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-2 0V4H5v12h10v-2a1 1 0 112 0v3a1 1 0 01-1 1H4a1 1 0 01-1-1V3z" clip-rule="evenodd"/>
                  <path fill-rule="evenodd" d="M6 10a1 1 0 011-1h6l-2-2a1 1 0 112-2l4 4a1 1 0 010 2l-4 4a1 1 0 11-2-2l2-2H7a1 1 0 01-1-1z" clip-rule="evenodd"/>
                </svg>
                <span id="login-text">LOG IN</span>
              </button>
            </div>
          </form>

          <div class="demo-info">
            <p><strong>DEMO UI:</strong> Tampilan visual saja, belum ada sistem login.</p>
          </div>
        </div>
      </section>
    </div>
  </div>

  <script src="scriptlgn.js"></script>
</body>
</html>
