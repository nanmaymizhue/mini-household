<nav class="navbar navbar-expand-lg bg-light navbar-text-primary">
  <div class="container-fluid">    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/"><h5>Home</h5></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cashflow"><h5>Cashflow</h5></a>
        </li>
      </ul>
    </div>
    <?php if ($_SESSION['user']['email'] ?? false): ?>
      <span class="navbar-text me-2">
       <?= $_SESSION['user']['username'] ?> 
      </span>
      <span class="navbar-text me-2">
        |
      </span>
      <span class="navbar-text me-2">
        <a href="logout">Logout <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
      </span>
    <?php else: ?>
      <span class="navbar-text me-2">
        <a href="register">Register </a>
      </span>
      <span class="navbar-text me-2">
        |
      </span>
      <span class="navbar-text me-2">
        <a href="login"> Login</a>
      </span>
    <?php endif; ?>

  </div>
</nav>
