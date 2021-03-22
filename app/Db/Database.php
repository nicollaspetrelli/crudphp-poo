<?php 

namespace NicollasDev\Db;

use \PDO;
use \PDOException;

class Database 
{
    const HOST = 'localhost';
    const DBNAME = 'dev_vagas';
    const USER = 'root';
    const PASS = '123456';
    
    /**
     * Nome da tabela a ser manipulado
     * @var string
     */
    private $table;
    
    /**
     * Instancia de conexão com o banco
     *
     * @var PDO
     */
    private $connection;
    
    /**
     * Define a tabela e instancia a conexão
     *
     * @param string $table
     * @return void
     */
    public function __construct(String $table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }
    
    /**
     * Cria uma conexão com o banco de dados
     * @return void
     */
    private function setConnection() {
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME, self::USER, self::PASS);

            // Define o erro de SQL para lançar uma exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $th) {
            throw $th;
            die($th->getMessage());
        }
    }
        
    /**
     * Executar queries dentro do banco de dados
     *
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);

            return $statement;
        } catch (\PDOException $th) {
            throw $th;
            die($th->getMessage());
        }
    }

    /**
     * Insere dados no banco
     *
     * @param array $values [ field => value]
     * @return integer ID inserido
     */
    public function insert(Array $values)
    {
        // Dados da query
        $fields = array_keys($values);

        // Verifica e cria binds de acordo com o numero de campos
        $binds = array_pad([], count($fields), '?');

        // Monta a query
        $fields = implode(',', $fields);
        $binds = implode(',', $binds);
        $query = "INSERT INTO ".$this->table." (".$fields.") VALUES (".$binds.")";

        // Valores do array
        $values = array_values($values);

        // Executa a query no banco
        $this->execute($query, $values);

        // Retrona o ID inserido
        $id = $this->connection->lastInsertId();

        return $id;
    }
    
    /**
     * Faz um select no banco de dados
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        // Dados da query
        $where = strlen($where) ? 'WHERE '.$where : '';
        $order = strlen($order) ? 'ORDER BY '.$order : '';
        $limit = strlen($limit) ? 'LIMIT '.$limit : '';

        // Monta a query
        $query = 'SELECT '.$fields.' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;

        return $this->execute($query);
    }
        
    /**
     * Atualiza informações no banco de dados
     *
     * @param string $where
     * @param array $values [ field => value]
     * @return boolean
     */
    public function update($where, $values)
    {
        // Dados da query
        $fields = array_keys($values);
        $fields = implode('=?,', $fields);

        // Monta a query
        $query = 'UPDATE '.$this->table.' SET '.$fields.'=? WHERE '.$where;

        // Executa a query
        $this->execute($query, array_values($values));

        // Retrona sucesso
        return true;
    }
        
    
    /**
     * Exclui dados do banco
     *
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
        // Monta a query
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        // Executa a query
        $this->execute($query);

        // Retrona sucesso
        return true;
    }
}