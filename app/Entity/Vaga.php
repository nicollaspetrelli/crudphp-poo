<?php 

namespace NicollasDev\Entity;

use NicollasDev\Db\Database;
use \PDO;

class Vaga {    
    
    /**
     * Identificado único da vaga
     * @var integer
     */
    public $id;
        
    /**
     * Titulo da vaga
     * @var string
     */
    public $titulo;
    
    /**
     * Descrição da vaga (pode conter html)
     * @var string
     */
    public $descricao;
    
    /**
     * Define se a vaga está ativa
     * @var string(s/n);
     */
    public $ativo;
    
    /**
     * Data da publicação da vaga
     * @var string
     */
    public $data;
    
    /**
     * Seta os parametros como atributos do objeto
     *
     * @param  mixed $titulo
     * @param  mixed $descricao
     * @param  mixed $ativo
     * @return void
     */
    public function setFields(String $titulo, String $descricao, String $ativo)
    {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->ativo = $ativo;
    }
        
    /**
     * Responsavel por obter a listagem de vagas no banco de dados
     *
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getVagas($where = null, $order = null, $limit = null)
    {
        return (new Database('vagas'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }
    
    /**
     * Retorna a consulta de uma vaga atrávez do ID
     *
     * @param integer $id
     * @return Vaga
     */
    public static function getVaga($id)
    {
        return (new Database('vagas'))->select('id = '.$id)->fetchObject(self::class);
    }
    
    /**
     * Calcula a quantidade de Vagas
     *
     * @param string $where
     * @return integer
     */
    public static function getQuantidadeVagas($where = null)
    {
        return (new Database('vagas'))->select($where, null, null, 'COUNT(*) as quantidade')->fetchObject()->quantidade;
    }

    /**
     * Método responsável por cadastrar uma nova vaga no banco
     * @return boolean
     */
    public function cadastrar()
    {
        // Definir a data
        $this->data = date('Y-m-d H:i:s'); // Formato Americano para o Banco

        // Cria uma instancia do banco de dados
        $db = new Database('vagas');

        // Insere os dados no banco de retorna o ID
        $this->id = $db->insert([
            'titulo'    => $this->titulo,
            'descricao' => $this->descricao,
            'ativo'     => $this->ativo,
            'data'      => $this->data 
        ]);
        
        // Retorna Sucesso!
        return true;
    }
    
    /**
     * Atualiza a vaga no banco de dados
     *
     * @return boolean
     */
    public function atualizar()
    {
        return (new Database('vagas'))->update('id = '.$this->id, [
            'titulo'    => $this->titulo,
            'descricao' => $this->descricao,
            'ativo'     => $this->ativo,
            'data'      => $this->data 
        ]);
    }
    
    /**
     * Excluir a vaga do banco de dados
     *
     * @return boolean
     */
    public function excluir()
    {
        return (new Database('vagas'))->delete('id = '.$this->id);
    }
}