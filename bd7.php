<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>

    <form>
        Nome: <input name="nome">
        <br>
        Nota: <input name="nota">
        <br>
        Idade: <input name="idade">
        <br />
        <button>Cadastrar</button>
    </form>

    <?php
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "aulaphp";
    $porta = 3306;

    $conexao = new PDO("mysql:host=$host;port=$porta;dbname=$banco", $usuario, $senha);


    if (isset($_GET["nome"])) {

        $nome = $_GET["nome"];
        $nota = $_GET["nota"];
        $idade = $_GET["idade"];

        $sql = "INSERT INTO notas (nome,nota,idade) VALUES (:nome,:nota,:idade)";
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":nota", $nota);
        $consulta->bindParam(":idade", $idade);
        $consulta->execute();
    }

    if (isset($_GET["acao"])) {
        $id = $_GET["id"];
        $sql = "DELETE FROM notas WHERE id = :id";
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
    }



    $sql = "SELECT id,nome,nota,idade FROM notas";
    $consulta = $conexao->prepare($sql);
    $consulta->execute();
    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);
    echo "<table border=1><tr><td>ID</td><td>Nome</td><td>Nota</td><td>Idade</td><td>Ação</td></tr>";
    foreach ($resultados as $cadastro) {
        $id = $cadastro["id"];
        $nome = $cadastro["nome"];
        $nota = $cadastro["nota"];
        $idade = $cadastro["idade"];
    ?>
        <tr>
            <td><?= $id ?></td>
            <td><?= $nome ?></td>
            <td><?= $nota ?></td>
            <td><?= $idade ?></td>
            <td><a href=bd7.php?acao=remover&id=<?= $id ?>>Remover</a></td>
        </tr>
    <?php

    }

    echo "</table>";


    ?>

</body>

</html>