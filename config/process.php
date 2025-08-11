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
    // EDITAR CONTATO // **CONTATOS EXCLUIDOS, QUE DEPOIS FOREM EDITADOS VOLTARÁ PARA ATIVO**
    else if ($data["type"] === "edit"){

        $nome = $data['nome'];
        $telefone = $data['phone'];
        $email = $data['email'];
        $observations = $data['observations'];
        $id = $data['id'];
        $is_ativo = 1;

        $query = "UPDATE contacts 
                  SET nome = :nome, 
                  phone = :telefone, 
                  email = :email,
                  observations = :observations,
                  is_ativo = :is_ativo
                  WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":nome" , $nome);
        $stmt->bindParam(":telefone" , $telefone);
        $stmt->bindParam(":email" , $email);
        $stmt->bindParam(":observations" , $observations);
        $stmt->bindParam(":is_ativo" , $is_ativo);
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

    //  NÃO DELETA DO BANCO, DEIXA INATIVO

    else if ($data["type"] === "delete"){

        $id = $data['id'];
        $is_ativo = 0;

        $query = "UPDATE contacts SET is_ativo = :is_ativo WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":is_ativo" , $is_ativo);
        $stmt->bindParam(":id" , $id);

        try {
            $stmt->execute();
            $_SESSION['msg'] = " !!! Contato Excluído !!!";

        }catch(PDOException $e){

            // erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    }
    // DELETE PERMANENTEMENTE O CONTATO
    else if ($data["type"] === "deleteds"){

        $id = $data['id'];

        $query = "DELETE FROM contacts WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id" , $id);

        try {
            $stmt->execute();
            $_SESSION['msg'] = " !!! Contato Excluído Permanentemente !!!";

        }catch(PDOException $e){

            // erro na conexão
            $error = $e->getMessage();
            echo "Erro: $error";
        }
    }

    // REDIRECT HOME
    header("Location:" . $BASE_URL . "../home.php");

    }
     else {
        // SELEÇÃO DE DADOS
        
    $id;

    if(!empty($_GET)){
        $id = $_GET["id"];
    }

    // RETORNA DADO DE UM CONTATO
    if(!empty($id)){

        $query = "SELECT * FROM contacts WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":id" , $id);
        
        $stmt->execute();

        $contact = $stmt->fetch();

    }

    else {

    // RETORNA TODOS OS CONTATOS ATIVOS COM iS_ATIVO = 1

        $contacts = [];

        $is_ativo = 1;


        $query = "SELECT * FROM contacts WHERE is_ativo = :is_ativo";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":is_ativo" , $is_ativo);

        $stmt->execute();

        $contacts = $stmt->fetchAll();


        // RETORNA TODOS OS CONTATOS EXCLUIDOS COM IS_ATIVO = 0

        $deleteds = [];

        $is_ativo = 0;

        $query = "SELECT * FROM contacts WHERE is_ativo = :is_ativo";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(":is_ativo" , $is_ativo);

        $stmt->execute();

        $deleteds = $stmt->fetchAll();
    } 
}

// FECHAR CONEXÃO

$conn = null;