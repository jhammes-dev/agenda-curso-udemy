<?php

session_start();

include_once ("connection.php");
include_once ("url.php");

$data = $_POST;

//MODIFICAÇÕES NO BANCO
if (!empty($data)){
 
    // CRIAR CONTATO
    if($data["type"] === "create"){

        $nome = $data['nome'];
        $telefone = $data['phone'];
        $email = $data['email'];
        $observations = $data['observations'];

        $query = "INSERT INTO contacts (nome,phone,email,observations)
        VALUES (:nome,:telefone,:email,:observations)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":nome" , $nome);
        $stmt->bindParam(":telefone" , $telefone);
        $stmt->bindParam(":email" , $email);
        $stmt->bindParam(":observations" , $observations);
        
        
        try {
            $stmt->execute();
            $_SESSION['msg'] = "Contato Criado com Sucesso !!!";
            

        }catch(PDOException $e){

            // erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }

    }
    // EDITAR CONTATO
    else if ($data["type"] === "edit"){

        $nome = $data['nome'];
        $telefone = $data['phone'];
        $email = $data['email'];
        $observations = $data['observations'];
        $id = $data['id'];

        $query = "UPDATE contacts 
                  SET nome = :nome, 
                  phone = :telefone, 
                  email = :email,
                  observations = :observations
                  WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":nome" , $nome);
        $stmt->bindParam(":telefone" , $telefone);
        $stmt->bindParam(":email" , $email);
        $stmt->bindParam(":observations" , $observations);
        $stmt->bindParam(":id" , $id);

        try {
            $stmt->execute();
            $_SESSION['msg'] = "Contato Atualizado com Sucesso !!!";
            

        }catch(PDOException $e){

            // erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }

    }

    // DELETAR CONTATO

    else if ($data["type"] === "delete"){

        $id = $data['id'];

        $query = "DELETE FROM contacts WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id" , $id);

        try {
            $stmt->execute();
            $_SESSION['msg'] = " !!! Contato Deletado !!!";
            

        }catch(PDOException $e){

            // erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }


    }


    // REDIRECT HOME
    header("Location:" . $BASE_URL . "../home.php");

    } else {
        // SELEÇÃO DE DADOS
        
    $id;

    if(!empty($_GET)){
        $id = $_GET["id"];
    }

    // retorna dados de um contato
    if(!empty($id)){


        $query = "SELECT * FROM contacts WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id" , $id);
        
        $stmt->execute();

        $contact = $stmt->fetch();

    } else {

    // retorna todos os contatos

        $contacts = [];

        $query = "SELECT * FROM contacts";

        $stmt = $conn->prepare($query);

        $stmt->execute();

        $contacts = $stmt->fetchAll();

    }
}

// FECHAR CONEXÃO

$conn = null;