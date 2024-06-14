<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700; /* Negrito */
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Livros</h2>
    <!-- ... -->

    <!-- Blocos de Livros -->
    <div class="row mt-3">
        <?php foreach ($listaLivro as $li) : ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">
                        <?php 
                            $obra = array_filter($listaObra, function($o) use ($li) {
                                return $o['id'] == $li['id_obra'];
                            });
                            if(count($obra) > 0){
                                $obra = array_values($obra)[0];
                                echo anchor("Livro/editar/".$obra['id'], $obra['titulo'] .' #'.$li ['id'] );
                            }
                        ?>
                    </h5>git add .
                        <p class="card-text">Disponível: <?= $li['disponivel'] ?></p>
                        <p class="card-text">Status: <?= $li['status'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- ... -->

</body>
</html>
