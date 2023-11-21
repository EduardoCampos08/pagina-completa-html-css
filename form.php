

<!DOCTYPE html>
<html lang="es">
<head>
    
<link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="media/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <div class="container">
            <img src="media/logo.png" alt="" class="logo">
            <nav>
                <a href="index.php">Inicio</a>
            </nav>
        </div>



        <h2>Iniciar sesión</h2>

<?php if (isset($error)) { echo "<p>$error</p>"; } ?>
<div class="containerForm">
<form method="post" action="form.php" class="form">
            
            <label>Correo:</label>
            <input type="text" name="correo" required>
            <label>Clave:</label>
            <input type="password" name="clave" required>

            <button type="submit">Iniciar sesión</button>
        </form>
</div>
        
    </header>
   
</body>
</html>


<?php
session_start();

include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND clave = '$clave'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['nombre'] = $row['nombre'];
        header("Location: map.php");
    } else {
        $error = "Correo o clave incorrectos";
    }
}
?>

