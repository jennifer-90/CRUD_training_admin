<?php

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php if (!empty($_SESSION['name'])): ?>
                            <li><a class="navbar-brand" href="#"><img src="picturesWeb/logo.png" alt="Logo"></a></li>
                            <li class="nav-item">&#128994; Connecté </li>
                            <li class="nav-item"><a class="nav-link" href="index.php?sent=views/arrayFormations">Toutes les formations</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.php?sent=views/activeArrayFormations">Formations actives</a></li>
                            <li class="nav-item"><a class="nav-link" href="index.php?sent=views/nonActiveArrayFormations">Formations suspendues</a></li>

                            <li class="nav-item"><a class="nav-link" href="index.php?sent=app/logout">Déconnexion</a>

                            <li class="nav-item"><a class="nav-link" href="index.php?sent=app/logout"></a>
                            </li>

                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="index.php?sent=views/authLoginView"></a></li>
                            <li class="nav-item">&#128308; Déconnecté </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-md-9">
        </div>
    </div>
</div>
