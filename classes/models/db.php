<?php 

class Models
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            'mysql:host=localhost;dbname=meu_banco_de_dados',
            'root',
            ''
        );
    }   

    public function insert_values($nome = "", $email = "", $senha = "")
    {
        try {
            
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";

            $senha = md5($senha);
    
            $bd = $this->pdo->prepare($sql);
            $bd->bindParam(1, $nome);
            $bd->bindParam(2, $email);
            $bd->bindParam(3, $senha);
    
            $bd->execute();

            return "Usuário inserido com sucesso!";

        } catch (PDOException $e) {
            
            return $e->getMessage();

        }
    }

    public function get_all()
    {   
        $sql = "SELECT * FROM usuarios";

        $bd = $this->pdo->prepare($sql);
        $bd->execute();

        while ($row = $bd->fetch(PDO::FETCH_OBJ))
        {
            if ($row)
            {
                return $row;
            }
        }

        return array("Data not found");
    }
}