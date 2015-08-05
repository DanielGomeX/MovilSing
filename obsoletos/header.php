<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $titulo; ?></title>
    <link href="<?php echo base_url();?>static/css/estilos.css" rel="stylesheet" type="text/css">
</head> 
<body>
    <header>
        <section class="contenedor">
            <h1>Movil SING</h1>

        </section>
    </header>
    <?php if (!isset($_SESSION['cliente'])): ?>
    <nav>
        <section class="contenedor">
            <ul>
                <li><?php echo anchor('logout','Salir') ?></li>
                <li><?php echo anchor('#','Indicadores') ?></li> 
                <li><?php echo anchor('planruta','Plan Ruta') ?></li> 
                <li><?php echo anchor('#','Prospectos') ?></li> 
                <li><?php echo anchor('#','Reportes') ?></li> 
                <li><?php echo anchor('#','Devoluciones') ?></li> 
            </ul>
        </section>
    </nav>
    <?php     
    else:
        ?>
    <nav>
        <section class="contenedor">
        </section>
    </nav>
<?php endif; ?>
<section class="contenedor">