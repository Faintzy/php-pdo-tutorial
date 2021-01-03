<?php 

/**
 * Classe Models
 * 
 * @author Github.com/Faintzy
 */

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

    /**
     * Func name: insert_value
     * 
     * Description: Insert values on usuarios table.
     * 
     * Return type: string
     */

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

    /**
     * Func name: get_all
     * 
     * Description: Get all data from table usuarios.
     * 
     * Return type: array
     */

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

    /**
     * Func name: get_user_data_by_id
     * 
     * Description: Get all user data based on id
     * 
     * Return type: array
     */

    public function get_user_data_by_id($id = "")
    {
        $sql = "SELECT * FROM usuarios WHERE id = ?";

        $bd = $this->pdo->prepare($sql);
        $bd->bindParam(1, $id);

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