<?php $render('header');?>

<?php $render('topo', ['loggedAluno' => $loggedAluno]);?>

<div class="curso-info">
    <img src="<?=$base;?>/assets/uploads/<?=$curso['imagem'];?>" border="0" height="60" />

    <h3><?=$curso['nome']?></h3>
</div>
<div class="cursos-container">
    <div class="cursos-left">
        <?php foreach($modulos as $modulo): ?>

            <div class="modulo"><?php echo utf8_encode($modulo['nome']);?></div>
            
            <?php foreach($modulo['aulas'] as $aula): ?>
                <a href="<?=$base;?>/cursos/aula/<?=$aula['id']?>">
                    <div class="aulas">
                        <?php echo $aula['nome'];?>                   
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
    <div class="cursos-right">

    </div>
</div>


<?php $render('footer');?>