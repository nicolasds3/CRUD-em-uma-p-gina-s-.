<?php

//banco de dados
$server_name = "localhost";
$user_name = "root";
$password = "root";
$dbname = "sistema_pedidos_nicolas";
$conn = new mysqli($server_name, $user_name, $password, $dbname);

if($conn -> connect_error) {
    die("Conexão falhou!!!" . $conn -> connect_error); 
}

//create

if (isset($_POST['create'])) {
    $nome_cliente = $_POST['nome_cliente'];
    $nome_produto = $_POST['nome_produto'];
    $quantidade = $_POST['quantidade'];
    $data_pedido = $_POST['data_pedido'];
    
    $sql = "INSERT INTO pedidos (nome_cliente, nome_produto, quantidade, data_pedido) VALUES ('$nome_cliente', '$nome_produto', '$quantidade', '$data_pedido')";

    if ($conn -> query($sql) === TRUE) {
        echo "Novo pedido criado com sucesso!";
    } else {
        echo "Erro" . $sql . "<br>" . $conn -> error;
    }
}

//delete

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM pedidos WHERE id = '$id'";

    if ($conn -> query($sql) === true) {
        echo "Pedido deletado com sucesso!";
    } else {
        echo "Erro" . $sql . "<br>" . $conn -> error;
    }
};

//update

if (isset($_GET['update'])) {
    $id = $_GET['id'];

    $nome_cliente = $_GET['nome_cliente'];
    $nome_produto = $_GET['nome_produto'];
    $quantidade = $_GET['quantidade'];
    $data_pedido = $_GET['data_pedido'];

    $sql = "UPDATE pedidos SET nome_cliente = '$nome_cliente', nome_produto = '$nome_produto', quantidade = '$quantidade', data_pedido = '$data_pedido' WHERE id = '$id'";

    if ($conn -> query($sql) === true) {
        echo "Pedido alterado com sucesso!";
    } else {
        echo "Erro" . $sql . "<br>" . $conn -> error;
    }
}

//read

$result = $conn -> query("SELECT * FROM pedidos");

if ($result -> num_rows > 0) {
    echo " <h1>Read</h1>
    <table border = '1'>
    <tr>
        <th>ID: </th>
        <th>Nome: </th>
        <th>nome_produto: </th>
        <th>quantidade: </th>
        <th>data_pedido: </th>
        <th>Ações: </th>
    </tr>
    ";
    while ($row = $result -> fetch_assoc()) {
    echo "  <tr>
                <td>{$row['id']}</td>
                <td>{$row['nome_cliente']}</td>
                <td>{$row['nome_produto']}</td>
                <td>{$row['quantidade']}</td>
                <td>{$row['data_pedido']}</td>
                <td>
                    <a href='index.php?delete={$row['id']}'>Excluir</a>
                </td>
            </tr>
    ";
    }
    echo "</table>";
} else {
    echo "Nenhum registro encontrado";
}
?>

<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tudo na mesma tela</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div>
            <h1>Create</h1>
            <form method="POST">
                <label for="nome_cliente">Nome do cliente: </label>
                <input type="text" name="nome_cliente" required>

                <label for="nome_produto">Nome do produto: </label>
                <input type="text" name="nome_produto" required>

                <label for="quantidade">Quantidade do produto: </label>
                <input type="number" name="quantidade" required>

                <label for="data_pedido">Data do pedido: </label>
                <input type="date" name="data_pedido" required>

                <input type="submit" name="create" value="Adicionar">
            </form>
        </div>
        <div>
            <h1>Update</h1>
            <form method="update">
                <label for="id">ID do pedido: </label>
                <input type="number" name="id" required>

                <label for="nome_cliente">Novo nome do cliente: </label>
                <input type="text" name="nome_cliente"required>

                <label for="nome_produto">Novo novo nome do produto: </label>
                <input type="text" name="nome_produto"required>

                <label for="quantidade">Nova quantidade do produto: </label>
                <input type="number" name="quantidade"required>

                <label for="data_pedido">Nova data do pedido: </label>
                <input type="date" name="data_pedido"required>

                <input type="submit" name="update" value="Alterar pedido">
            </form>
        </div>
    </body>
</html>