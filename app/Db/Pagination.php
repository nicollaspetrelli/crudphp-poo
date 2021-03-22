<?php 

namespace NicollasDev\Db;

class Pagination 
{    
    /**
     * Numero máximo de registros por página
     *
     * @var integer
     */
    private $limit;
    
    /**
     * Quantidade total de resultado do banco
     *
     * @var integer
     */
    private $results;
    
    /**
     * Quantidade de páginas
     *
     * @var integer
     */
    private $pages;
    
    /**
     * Página atual
     *
     * @var integer
     */
    private $currentPage;
    
    /**
     * Construtor da pagina
     *
     * @param integer $results
     * @param integer $currentPage
     * @param integer $limit
     */
    public function __construct($results, $currentPage = 1, $limit = 10)
    {
        $this->results     = $results;
        $this->limit       = $limit;
        $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
        $this->calculate();
    }
    
    /**
     * Método reponsável por calcular a páginação
     *
     * @return void
     */
    private function calculate()
    {
        // Calcula o total de páginas
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        // Verifica se a página atual não exede o número de páginas
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }
    
    /**
     * Retorna a cláusula limit para a query SQL
     *
     * @return string
     */
    public function getLimit()
    {
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset.','.$this->limit;
    }

    public function getPages()
    {
        // Não Retorna Páginas
        if ($this->pages == 1) return [];

        // Páginas
        $paginas = [];
        for ($i=1; $i <= $this->pages; $i++) { 
            $paginas[] = [
                'pagina' => $i,
                'atual'  => $i == $this->currentPage
            ];
        }
        
        return $paginas;
    }
}