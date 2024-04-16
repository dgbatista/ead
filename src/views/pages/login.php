<?php $render('header');?>

<form class="form-login" method="POST">
    <h2>Login</h2>
    <input type="email" name="email" placeholder="E-mail" /><br/><br/>

    <input type="password" name="senha" placeholder="******"/><br/><br/>

    <input type="submit" value="Entrar" />
</form>

<?php $render('footer');?>