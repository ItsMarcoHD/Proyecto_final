<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

$mensaje = null;
$esExito = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $img = null;

    // Subida de imagen
    if (!empty($_FILES['imagen']['name'])) {
        // Validar error de subida
        if ($_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
            $mensaje = "❌ Error al subir archivo: código " . $_FILES['imagen']['error'];
        } else {
            // Sanitizar nombre del archivo
            $nombreOriginal = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", basename($_FILES['imagen']['name']));
            $img = uniqid() . '_' . $nombreOriginal;

            // Definir ruta absoluta de la carpeta uploads
            $rutaCarpeta = __DIR__ . "/../uploads";

            // Crear carpeta si no existe
            if (!is_dir($rutaCarpeta)) {
                if (!mkdir($rutaCarpeta, 0755, true)) {
                    $mensaje = "❌ No se pudo crear la carpeta uploads.";
                }
            }

            // Verificar permisos de escritura
            if (!$mensaje && !is_writable($rutaCarpeta)) {
                $mensaje = "❌ La carpeta uploads no tiene permisos de escritura.";
            }

            $rutaDestino = $rutaCarpeta . "/" . $img;
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];

            if (!$mensaje) {
                if (in_array($_FILES['imagen']['type'], $tiposPermitidos)) {
                    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
                        $mensaje = "❌ Error al mover la imagen al servidor.";
                        error_log("Error al mover {$_FILES['imagen']['tmp_name']} a $rutaDestino");
                    }
                } else {
                    $mensaje = "⚠️ Formato de imagen no permitido.";
                }
            }
        }
    }

    // Si no hay error previo
    if (!$mensaje) {
        $data = [
            'titulo' => trim($_POST['titulo']),
            'descripcion' => trim($_POST['descripcion']),
            'url_github' => trim($_POST['url_github']),
            'url_produccion' => trim($_POST['url_produccion']),
            'imagen' => $img
        ];

        // URL de la API
        $ch = curl_init('https://teclab.uct.cl/~marco.sandoval/Proyecto_Final/api/proyectos.php');

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_COOKIE => 'PHPSESSID=' . session_id(),
            CURLOPT_TIMEOUT => 15
        ]);

        $response = curl_exec($ch);

        // Manejo de errores cURL
        if ($response === false) {
            $mensaje = "❌ Error de cURL: " . curl_error($ch);
        } else {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $resultado = json_decode($response, true);

            if (($httpCode === 200 || $httpCode === 201) && isset($resultado['success'])) {
                $mensaje = "✅ Proyecto guardado exitosamente. Redirigiendo...";
                $esExito = true;
                header("refresh:2;url=index.php");
            } else {
                $mensaje = "❌ Error al guardar el proyecto. Código HTTP: $httpCode";
                if (isset($resultado['error'])) {
                    $mensaje .= "<br>Mensaje: " . htmlspecialchars($resultado['error']);
                }
            }
        }

        curl_close($ch);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Agregar Proyecto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="mb-4 text-primary">Agregar Proyecto</h2>

    <a href="index.php" class="btn btn-outline-secondary mb-3">← Volver al panel</a>

    <?php if ($mensaje): ?>
      <div class="alert <?= $esExito ? 'alert-success' : 'alert-danger' ?> text-center">
        <?= $mensaje ?>
      </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="titulo" class="form-label">Título:</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required />
      </div>

      <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" maxlength="200" required></textarea>
      </div>

      <div class="mb-3">
        <label for="url_github" class="form-label">URL GitHub:</label>
        <input type="url" class="form-control" id="url_github" name="url_github" />
      </div>

      <div class="mb-3">
        <label for="url_produccion" class="form-label">URL Producción:</label>
        <input type="url" class="form-control" id="url_produccion" name="url_produccion" />
      </div>

      <div class="mb-3">
        <label for="imagen" class="form-label">Imagen:</label>
        <input type="file" class="form-control" id="imagen" name="imagen" required />
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-success">Guardar Proyecto</button>
      </div>
    </form>
  </div>
</body>
</html>
