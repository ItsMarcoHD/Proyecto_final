<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Portafolio • Marco Sandoval</title>
  <meta name="description" content="Portafolio web de Marco Sandoval, desarrollador con conocimientos en PHP, MySQL y diseño web.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar {
      background-color: #a00000;
    }
    .navbar-brand, .nav-link {
      color: white !important;
      font-weight: bold;
    }
    .hero {
      background-color: #fff3f3;
      padding: 4rem 2rem;
      text-align: center;
      margin-top: 2rem;
      border-radius: 15px;
    }
    .btn-red {
      background-color: #c00000;
      color: white;
    }
    .btn-red:hover {
      background-color: #990000;
    }
    footer {
      text-align: center;
      padding: 2rem;
      margin-top: 3rem;
      background-color: #a00000;
      color: white;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Mi Nombre</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon bg-light"></span>
    </button>
    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="#sobre-mi">Sobre Mí</a></li>
        <li class="nav-item"><a class="nav-link" href="#formacion">Formación</a></li>
        <li class="nav-item"><a class="nav-link" href="#proyectos">Proyectos</a></li>
        <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
        <li class="nav-item"><a class="nav-link" href="login.php">Ir a Proyectos Finales</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero -->
<section class="container hero" id="inicio">
  <h1 class="display-5 fw-bold">Desarrollador Web • Full Stack</h1>
  <p class="lead">Soy Marco Sandoval!, estudiante de Técnico en Informática. Me especializo en el desarrollo web con HTML.</p>
  <a href="login.php" class="btn btn-red btn-lg mt-3">Ir a Proyectos Finales</a>
</section>

<!-- Sobre Mí -->
<section class="container mt-5" id="sobre-mi">
  <h2>Sobre Mí</h2>
  <img src="img/perfil.jpg" alt="Foto de Perfil" class="profile-img d-block mx-auto">
  <p>A mi me encanta la musica, escucho todo un poco, soy fanatico de los PCs y los automoviles, por el momento me especializo en HTML.</p>
</section>

<!-- Formación -->
<section class="container mt-5" id="formacion">
  <h2>Formación</h2>
  <ul>
    <li>Técnico Universitario en Informática – Universidad Catolica de Temuco</li>
    <li>Cursos en HTML, CSS, JavaScript, PHP y MySQL</li>
    <li>Práctica Profesional en desarrollo y soporte técnico</li>
  </ul>
</section>

<!-- Proyectos -->
<section class="container mt-5" id="proyectos">
  <h2>Proyectos</h2>
  <p>Aquí se muestran algunos de los trabajos que he realizado. Puedes ver más en el panel de administración.</p>
</section>

<!-- Contacto -->
<section class="container mt-5" id="contacto">
  <h2>Contacto</h2>
  <p>Correo: msandoval2024@alu.uct.cl</p>
  <p>GitHub: <a href="#">github.com/ItsMarcoHD</a></p>
</section>

<!-- Footer -->
<footer>
  <p>&copy; 2025 Marco Sandoval. Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
