<?php
$cadena = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-lock-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2"/>
                    </svg>';

$sessionVerrou = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lock" viewBox="0 0 16 16">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m0 5.996V14H3s-1 0-1-1 1-4 6-4q.845.002 1.544.107a4.5 4.5 0 0 0-.803.918A11 11 0 0 0 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664zM9 13a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
</svg>';
/*---------------------------------------------------------------*/
?>
<h1>LearnZone</h1><br>

<div class="center-container">
    <div class="form-container">
        <img src="picturesWeb/logo.png" class="logo" alt="Logo">

        <h2>SE CONNECTER</h2><br>

        <div class="icon-large"><?php echo $sessionVerrou ?><br></div>
        <br>

        <form action="index.php?sent=app/authLogin" method="post">
            <div>
                <input class="form-control input-field" type="text" id="nameCss" name="name" placeholder="Nom"><br>
                <input class="form-control input-field" type="password" id="passwordCss" name="password"
                       placeholder="Mot de passe"><br>
            </div>
            <div class="btn-container">
                <button class="btn btn-primary" type="submit">
                    <?php echo $cadena ?>
                    CONNEXION
                </button>
            </div>
        </form>
    </div>
</div><br><br>
