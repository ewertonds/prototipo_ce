<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registro de Ponto | HMMR</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv="Content-Security-Policy" content="default-src 'self';">
    
    <link rel='stylesheet' type='text/css' media='screen' href='/css/style.css'>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container">
<!--- php --->
<?php
// Conexão com o banco de dados
include('db_config.php');

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: ". $conn->connect_error);
}

// Consulta para obter opções do banco de dados
$sql = "SELECT id, nome_acad FROM registro_acad";
$result = $conn->query($sql);

// Cria um array para armazenar as opções
$options = array();

// Adiciona opções ao array
while ($row = $result->fetch_assoc()) {
    $options[] = $row;
}

// Submete o formulário para o BD
$nome = $_POST['nome'];
$email = $_POST['cpf'];
$tipo_serv = $_POST['tipoServico'];
$troca = $_POST['habilita-troca'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$endereco = $_POST['endereco'];
$periodo = $_POST['periodo'];
$email = $_POST['email'];
$comentarios = $_POST['comentarios'];



// Executar a consulta SQL para inserir dados
$sql = "INSERT INTO tabela_usuarios (nome, email) VALUES ('$nome', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso!";
} else {
    echo "Erro ao inserir dados: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna as opções como JSON
echo json_encode($options);
?>
<!----------->

    <header class="row align-items-center row-gap-4">
        <div class=" container col-8">
            <h1>REGISTRO DE PONTO VIRTUAL</h1>
            <p>Bem vindo ao Hospital da Mulher Mariska Ribeiro, preencha seus dados com atenção.<br>Tenha um ótimo dia
                de aprendizado!</p>
            <hr>
        </div>
    </header>
    <article class="row mx-auto">
        <form id="mainForm" class="container col-8" method="post">
            <div class="form-row">
                <div class="col-6">
                    <label for="nome">Nome:</label>
                    <select class="form-control" id="nome" name="nome">
                    </select>
    
                    <label for="cpf">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="Digite seu CPF"
                        pattern="\d{11}" title="CPF deve conter 11 dígitos numéricos" maxlength="11" required>
                    <small id="cpfHelp" class="form-text text-muted">Digite apenas os números do CPF.</small>
                </div>
    
                <div class="col-6">
                    <label for="tipoServico">Tipo de Serviço:</label>
                    <select class="form-control" id="tipoServico" name="tipoServico" onchange="habilitarTroca()">
                        <option value="fixo">Plantão Fixo/Estágio</option>
                        <option value="complementacao">Complementação</option>
                        <option value="reposicao">Reposição</option>
                        <option value="troca">Troca</option>
                        <option value="falta">Falta</option>
                    </select>

                    <label for="troca">Troca com:</label>
                    <input type="text" class="form-control" id="habilita-troca" name="troca" disabled>

                    <!-- Campos ocultos para armazenar coordenadas -->
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                    <input type="hidden" id="endereco" name="endereco">
                    <label for="periodo">Período:</label>
                    <select class="form-control" id="periodo" name="periodo">
                        <option value="manha" id="entrada">Entrada</option>
                        <option value="tarde" id="saida">Saída</option>
                    </select>
                </div>
            </div>

            <div class="form-group col-6">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email">
        </div>

        <div class="form-group col-6">
            <label for="comentarios">Comentários:</label>
            <textarea class="form-control" id="comentarios" name="comentarios" rows="4"
                placeholder="Digite seus comentários"></textarea>
        </div>

        <div class="d-flex gap-3 justify-content-end">
            <button type="submit" class="btn btn-primary">Submeter</button>
            <button type="reset" class="btn btn-secondary ml-2" onclick="limparForm()">Limpar</button>
        </div>
    </form>
</article>

    <footer class="row row-gap-4">
        <div class="container col-8 text-center">
            <img src="/img/LOGO e RODAPÉ HMMR 1rodape.png">
        </div>
    </footer>
    <script src='/js/main.js'></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="https://www.openlayers.org/api/OpenLayers.js"></script>
</body>

</html>