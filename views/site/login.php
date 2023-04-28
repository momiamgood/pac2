<div class="form-container">
    <p class="logo"><img class="logo-img" src="../../public/static/media/lib_logo.png">Библиотека</p>
    <h2>Вход в систему</h2>
    <h3><?= $message ?? ''; ?></h3>
    <h3><?= app()->auth->user()->name ?? ''; ?></h3>
    <?php
    if (!app()->auth::check()):
    ?>
    <form method="post">
        <label>Логин<input type="text" name="login"></label>
        <label>Пароль<input type="password" name="password"></label>
        <button class="submit-btn">Войти</button>
    </form>
</div>
<?php endif;

?>






