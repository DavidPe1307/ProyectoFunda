<?php
session_start();

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'guest') {
    // Si alguien entra directamente sin ser invitado, redirige al login
    header("Location: login.html");
    exit();
}

$usuario = $_SESSION['usuario']; // será "Invitado"
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pagina de bienvenida | UTA</title>
	<link rel="stylesheet" href="../css/syleinterfacewealcome.css">
</head>
<body>
	<nav>
		<ul class="menu-horizontal">
			<li><a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg> Cuenta</a>
                    <ul class="menu-vertical">
				    	<li><a href="login.html">Iniciar sesión</a></li>
			    	</ul>
            </li>
			
			<li>
				<a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-p-square" viewBox="0 0 16 16">
                    <path d="M5.5 4.002h2.962C10.045 4.002 11 5.104 11 6.586c0 1.494-.967 2.578-2.55 2.578H6.784V12H5.5zm2.77 4.072c.893 0 1.419-.545 1.419-1.488s-.526-1.482-1.42-1.482H6.778v2.97z"/>
                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                    </svg>
                    Slots
                </a>
				<ul class="menu-vertical">
					<li><a href="../frontend/guest_slots.php">Visualizar slots</a></li>
				</ul>
			</li>
			

		</ul>
	</nav>
	</nav>

            <div class="head">
                
                <h1>Bienvenido al historial de</h1>
                <h1>parqueo de la</h1>
                
                <h2>Universidad Técnica de Ambato</h2>
                <span id="current-user">Ha ingresado como invitado</span>
            <div class="imag">

                <img class= "logo" src="../img/found2one.png">
                <img class= "line" src="../img/linea.png">
                

            </div>
          
            </div>
            
            
            
   
</body>
</html>