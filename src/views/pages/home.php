<?php $render('header');?>

<?php $render('topo', ['loggedAluno' => $loggedAluno]);?>

    <h1>Seus Cursos</h1>
    <?php foreach($cursos as $curso): ?>
        <a href="<?=$base;?>/cursos/<?=$curso['id'];?>">
            <div class="cursoitem">
                <img src="<?=$base;?>/assets/uploads/<?=$curso['imagem']?>" border="0" width="300px" height="180px" /><br/><br/>

                <strong><?php echo $curso['nome']; ?></strong><br/><br/>

                <?php echo $curso['descricao']; ?>
            </div> 
        </a>
    <?php endforeach; ?>

<?php $render('footer');?>