<?php

namespace App\Config\src;

class Pagination{

  /**
   * Número máximo de registros por página
   * @var integer
   */
  private $limit;

  /**
   * Quantidade total de resultados do banco
   * @var integer
   */
  private $results;

  /**
   * Quantidade de páginas
   * @var integer
   */
  private $pages;

  /**
   * Página atual
   * @var integer
   */
  private $currentPage;

  /**
   * Número máximo de links de página a serem exibidos
   * @var integer
   */
  private $maxPages;

  /**
   * Construtor da classe
   * @param integer  $results
   * @param integer  $currentPage
   * @param integer  $limit
   * @param integer  $maxPages
   */
  public function __construct($results, $currentPage = 1, $limit = 10, $maxPages = 5){
    $this->results     = $results;
    $this->limit       = $limit;
    $this->currentPage = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
    $this->maxPages    = $maxPages;
    $this->calculate();
  }

  /**
   * Método responsável por calcular a paginação
   */
  private function calculate(){
    // CALCULA O TOTAL DE PÁGINAS
    $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

    // VERIFICA SE A PÁGINA ATUAL NÃO EXCEDE O NÚMERO DE PÁGINAS
    $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
  }

  /**
   * Método responsável por retornar a cláusula limit da SQL
   * @return string
   */
  public function getLimit(){
    $offset = ($this->limit * ($this->currentPage - 1));
    return $offset.','.$this->limit;
  }

  /**
   * Método responsável por retornar as opções de páginas disponíveis
   * @return array
   */
  public function getPages(){
    // NÃO RETORNA PÁGINAS
    if($this->pages == 1) return [];

    // PÁGINAS
    $pages = [];

    $startPage = max(1, $this->currentPage - floor($this->maxPages / 2));
    $endPage = min($this->pages, $startPage + $this->maxPages - 1);

    // Adiciona seta para a página anterior se houver mais páginas
    if ($startPage > 1) {
        $pages[] = [
            'page'    => $startPage - 1,
            'current' => false,
            'arrow'   => 'prev',
        ];
    }

    for ($i = $startPage; $i <= $endPage; $i++) {
        $pages[] = [
            'page'    => $i,
            'current' => $i == $this->currentPage,
            'arrow'   => null,
        ];
    }

    // Adiciona seta para a próxima página se houver mais páginas
    if ($endPage < $this->pages) {
        $pages[] = [
            'page'    => $endPage + 1,
            'current' => false,
            'arrow'   => 'next',
        ];
    }

    return $pages;
  }
}
