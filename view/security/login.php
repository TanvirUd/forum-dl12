<form action="?ctrl=security&action=login" method="post">
    <p>
        <label>
            Nom d'utilisateur ou adresse e-mail :
            <input type="text" name="credentials" required>
        </label>
    </p>
    <p>
        <label>
            Mot de passe :
            <input type="password" name="password" required>
        </label> 
    </p>
    <p>
        <input type="submit" value="Connexion">
        <input type="hidden" name="csrf_token" value="<?= $token ?>">
    </p>
</form>
<div class="redirentRegister">
    <a href="?ctrl=security&action=register" class="selectButton">Don't have an acount?</a>
</div>


    