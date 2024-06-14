<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimo</title>
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

<head>
    <!-- Seus outros metadados -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            // Aplica máscara de entrada para formatar o valor
            $('#data_inicio').mask('00/00/0000');

            // Converte a data do formato yyyy-mm-dd para dd/mm/aaaa ao enviar o formulário
            $('form').submit(function() {
                var dateParts = $('#data_inicio').val().split('-');
                var formattedDate = dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0];
                $('#data_inicio').val(formattedDate);
            });
        });
    </script>

<script>
    function calcularDataPrazo() {
        var dataInicio = document.getElementById('data_inicio').value;
        var prazo = parseInt(document.getElementById('prazo').value);
        
        if (dataInicio && prazo) {
            var dataInicioObj = new Date(dataInicio);
            var dataPrazoObj = new Date(dataInicioObj.getTime() + prazo * 24 * 60 * 60 * 1000);
            
            var dia = dataPrazoObj.getDate().toString().padStart(2, '0');
            var mes = (dataPrazoObj.getMonth() + 1).toString().padStart(2, '0');
            var ano = dataPrazoObj.getFullYear();
            
            var dataPrazoFormatada = dia + '/' + mes + '/' + ano;
            
            document.getElementById('data_prazo').value = dataPrazoFormatada;
        } else {
            document.getElementById('data_prazo').value = '';
        }
    }
</script>
</head>
</html>


<div class="container">
    <h2>Empréstimos</h2>
    <!-- Button do Modal -->
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Novo
    </button>

    <!-- Blocos de Empréstimos -->
    <div class="row mt-3">
        <?php foreach ($listaEmprestimo as $em) : ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= anchor("Emprestimo/editar/".$em['id'], "Empréstimo #" . $em['id']) ?></h5>
                        <p class="card-text">Data de Início: <?= $em['data_inicio'] ?></p>
                        <p class="card-text">Data do Fim: <?= $em['data_fim'] ?></p>
                        <p class="card-text">Data do Prazo: <?= $em['data_prazo'] ?></p>
                        <p class="card-text">Aluno: 
                            <?php
                            foreach ($listaAluno as $aluno) {
                                if ($aluno['id'] == $em['id_aluno']) {
                                    echo $aluno['nome'];
                                    break;
                                }
                            }
                            ?>
                        </p>
                        <p class="card-text">Usuário: 
                            <?php
                            foreach ($listaUsuario as $usuario) {
                                if ($usuario['id'] == $em['id_usuario']) {
                                    echo $usuario['nome'];
                                    break;
                                }
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?=form_open("Emprestimo/cadastrar")?> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Empréstimo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="data_inicio">Data de Inicio:</label>
                    <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                </div>
                <div class="form-group">
                    <label for="data_prazo">Data do Prazo:</label>
                    <input class='form-control' type="text" id='data_prazo' name='data_prazo'>
                </div>
                <div class="form-group">
                    <label for="telefone">Aluno:</label>
                    <select class='form-select' name="id_aluno" id="id_aluno" required>
                        <option value="" disabled selected>Selecione um Aluno</option>
                        <?php foreach($listaAluno as $aluno) : ?>
                        <option value="<?=$aluno['id']?>"><?=$aluno['nome']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="telefone">Usuario:</label>
                    <select class='form-select' name="id_usuario" id="id_usuario" required>
                        <option value="" disabled selected>Selecione um Usuário</option>
                        <?php foreach($listaUsuario as $usuario) : ?>
                        <option value="<?=$usuario['id']?>"><?=$usuario['nome']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-dark">Cadastrar</button>
            </div>
        </div>
    </div>
        <?=form_close()?>
    </div>
</div>