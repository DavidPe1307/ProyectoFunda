<?php
$token = $_GET['token'] ?? '';
$status = $_GET['status'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer Contraseña</title>
  <link rel="stylesheet" href="../css/styleforgot.css">
  <script src="https://kit.fontawesome.com/869dc8f5ef.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="form-container">
    <!-- Logo UTA -->
    <div style="margin-bottom: 20px;">
      <img src="../img/found2one.png" alt="Logo UTA" style="width: 80px;">
    </div>

    <h2>Restablecer Contraseña</h2>

    <?php if ($status === 'expirado'): ?>
      <div class="msg error">❌ El enlace ha expirado o ya fue usado. Solicita uno nuevo.</div>

    <?php elseif ($status === 'incompleto'): ?>
      <div class="msg error">⚠️ Por favor, completa todos los campos.</div>

    <?php elseif ($status === 'exito'): ?>
      <div class="msg success">✅ ¡Contraseña actualizada con éxito! Serás redirigido al inicio de sesión...</div>
      <button class="close-btn" onclick="window.close()">Cerrar esta pestaña</button>
      <script>
        setTimeout(() => {
          if (window.opener) {
            window.opener.location.href = '../frontend/login.html';
            window.close();
          } else {
            window.location.href = '../frontend/login.html';
          }
        }, 4000);
      </script>
    <?php endif; ?>

    <?php if ($status !== 'exito'): ?>
      <form method="POST" action="../database/update_password.php">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>" />
        
        <div class="password-container">
          <input type="password" name="new_password" id="newPassword" class="password-input" placeholder="Nueva contraseña" required />
          <button type="button" class="password-toggle" id="togglePassword">
            <i class="fas fa-eye eye-icon" id="eyeIcon"></i>
          </button>
        </div>
        
        <button type="submit">Restablecer</button>
      </form>
    <?php endif; ?>
  </div>

  <script src="../js/password_visibility.js"></script>
</body>
</html>
