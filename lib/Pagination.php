<?php

/**
 * Created by PhpStorm.
 * User: Thao
 * Date: 8/1/2015
 * Time: 10:44
 */
class Pagination
{
    private $totalRecord;
    private $recordPerPage;
    private $currentPage;
    private $totalPage;


    public function __construct($totalRecord, $recordPerPage, $currentPage)
    {
        $this->totalRecord = $totalRecord;
        $this->currentPage = $currentPage;
        $this->recordPerPage = $recordPerPage;
        $this->totalPage = ceil($totalRecord/$recordPerPage);
    }

    public function getOffset()
    {
        $offset = $this->recordPerPage * ($this->currentPage - 1);
        return $offset;
    }

    //href = 'index?controller=UserController&action=index&page='
    public function paginationPanel($href)
    {
        $nextHTML = '';
        $lastHTML = '';
        $firstHTML = '';
        $preHTML = '';
        $nextNumHTML = '';
        $preNumHTML = '';
        $next = $this->currentPage + 1;
        $pre = $this->currentPage - 1;


        if($this->currentPage == 1){
            $firstHTML = "<a class='first paginate_button paginate_button_disabled' href='#'>First</a>";
            $preHTML = "<a class='previous paginate_button paginate_button_disabled' href='#'>Previous</a>";
            $nextHTML = "<a class='next paginate_button' href='{$href}{$next}'>Next</a>";
            $lastHTML = "<a class='last paginate_button' href='{$href}{$this->totalPage}'>Last</a>";
            $nextNumHTML = "<a class='paginate_button' href='{$href}{$next}'>{$next}</a>";
            $preNumHTML = '';
        }

        if($this->currentPage == $this->totalPage){
            $firstHTML = "<a class='first paginate_button' href='{$href}1'>First</a>";
            $preHTML = "<a class='previous paginate_button' href='{$href}{$pre}'>Previous</a>";
            $nextHTML = "<a class='next paginate_button paginate_button_disabled' href='#'>Next</a>";
            $lastHTML = "<a class='last paginate_button paginate_button_disabled' href='#'>Last</a>";
            $preNumHTML = "<a class='paginate_button' href='{$href}{$pre}'>{$pre}</a>";
            $nextNumHTML = '';
        }

        if($this->currentPage > 1 && $this->currentPage < $this->totalPage){
            $firstHTML = "<a class='first paginate_button' href='{$href}1'>First</a>";
            $preHTML = "<a class='previous paginate_button' href='{$href}{$pre}'>Previous</a>";
            $nextHTML = "<a class='next paginate_button' href='{$href}{$next}'>Next</a>";
            $lastHTML = "<a class='last paginate_button' href='{$href}{$this->totalPage}'>Last</a>";
            $nextNumHTML = "<a class='paginate_button' href='{$href}{$next}'>{$next}</a>";
            $preNumHTML = "<a class='paginate_button' href='{$href}{$pre}'>{$pre}</a>";
        }

        if($this->totalPage == 1){
            $firstHTML = "<a class='first paginate_button paginate_button_disabled' href='{$href}1'>First</a>";
            $preHTML = "<a class='previous paginate_button paginate_button_disabled' href='#'>Previous</a>";
            $nextHTML = "<a class='next paginate_button paginate_button_disabled' href='#'>Next</a>";
            $lastHTML = "<a class='last paginate_button paginate_button_disabled' href='{$href}1'>Last</a>";
            $nextNumHTML = "";
            $preNumHTML = '';
        }


        if($this->totalPage == 0){
            $firstHTML = "<a class='first paginate_button paginate_button_disabled' href='#'>First</a>";
            $preHTML = "<a class='previous paginate_button paginate_button_disabled' href='#'>Previous</a>";
            $nextHTML = "<a class='next paginate_button paginate_button_disabled' href='#'>Next</a>";
            $lastHTML = "<a class='last paginate_button paginate_button_disabled' href='#'>Last</a>";
            $nextNumHTML = "";
            $preNumHTML = '';
        }

        if($this->totalPage == 2){
            $firstHTML = "";
            $preHTML = "";
            $nextHTML = "";
            $lastHTML = "";
            if($this->currentPage == 1) {
                $nextNumHTML = "<a class='paginate_button ' href='{$href}2'>2</a>";
                $preNumHTML = "";
            }
            if($this->currentPage == 2) {
                $nextNumHTML = "";
                $preNumHTML = "<a class='paginate_button ' href='{$href}1'>1</a>";
            }
        }

        $current = "<a class='paginate_active' href='{$href}{$this->currentPage}'>{$this->currentPage}</a>";
        $html = $firstHTML . $preHTML . $preNumHTML. $current . $nextNumHTML . $nextHTML . $lastHTML;
        return $html;
    }
}