<?php


namespace core;


class Pagination
{
    protected $numRows; // books in DB
    protected $rowsPage; // books in the page
    protected $totalPages; //  How many pages will there be;
    protected $range = 2; // links in the page
    protected $currentPage;
    
    public function __construct($numRows, $rowsPage)
    {
        $this->numRows = $numRows;
        $this->rowsPage = $rowsPage;
        $this->getTotalPages();
        $this->getCurrentPage();

        //var_dump($this->currentPage);
        //var_dump($this->pages);
        //var_dump($this->total);
    }

    public function get()
    {

        if($this->rowsPage < $this->numRows){



        $prevLink = ($this->currentPage > 1) ? '<a href="?page=' . ($this->currentPage - 1) . '"class="w3-bar-item w3-button">&laquo;</a>' : '';
        echo $prevLink;

        for ($x = ($this->currentPage - $this->range); $x < (($this->currentPage + $this->range) + 1); $x++) {
            if (($x > 0) && ($x <= $this->totalPages)) {
                if ($x == $this->currentPage) {
                    echo '<a href="#" class="w3-button w3-teal">' . $x . '</a>';
                } else {
                    echo '<a href="?page=' . ($x) . '" class="w3-button ">' . $x . '</a>';
                }
            }
        }
            $nextLink = ($this->currentPage < $this->totalPages) ? '<a href="?page=' . ($this->currentPage + 1) . '"class="w3-button">&raquo;</a>' : '';
            echo $nextLink;

        }
    }

    protected function getTotalPages()
    {
        $this->totalPages = ceil($this->numRows/ $this->rowsPage);
    }

    protected function getCurrentPage()
    {
        $op = ['options' => [
            'default' => 1,
            'min_range' => 1,
        ]];
        $page = min($this->totalPages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, $op));
        $this->currentPage = $page;
    }

}
