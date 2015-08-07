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

    public function getTotalRecord()
    {
        return $this->totalRecord;
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
        $button = 'paginate_button';
        $disable = 'paginate_button_disabled';
        $next3 = '';
        $pre1 = '';


        $current = "<a class='paginate_active' href='{$href}{$this->currentPage}'>{$this->currentPage}</a>";

        if($this->totalPage <4){
            $firstHTML = "<a class='first $button $disable' href='#'>First</a>";
            $preHTML = "<a class='previous $button $disable' href='#'>Previous</a>";
            $nextHTML = "<a class='next $button $disable' href='#'>Next</a>";
            $lastHTML = "<a class='last $button $disable' href='#'>Last</a>";
            if($this->totalPage == 0){
                $current='';
            }
            elseif($this->totalPage == 1){
                $preNumHTML = $nextNumHTML ='';
            }
            elseif($this->totalPage == 2){
                if($this->currentPage == 1){
                    $nextNumHTML = "<a class='$button ' href='{$href}2'>2</a>";
                    $preNumHTML = "";
                }
                if($this->currentPage == 2){
                    $nextNumHTML = "";
                    $preNumHTML = "<a class='$button ' href='{$href}1'>1</a>";
                }
            }
            else{
                if($this->currentPage == 1){
                    $nextNumHTML = "<a class='$button ' href='{$href}2'>2</a>";
                    $next3= "<a class='$button ' href='{$href}3'>3</a>";
                    $preNumHTML = "";
                }
                elseif($this->currentPage == 2){
                    $nextNumHTML = "<a class='$button ' href='{$href}{$next}'>{$next}</a>";
                    $preNumHTML = "<a class='$button ' href='{$href}{$pre}'>{$pre}</a>";
                }
                else{
                    $nextNumHTML = "";
                    $preNumHTML = "<a class='$button ' href='{$href}{$pre}'>{$pre}</a>";
                    $pre1 = "<a class='$button ' href='{$href}1'>1</a>";
                }
            }
        }
        else{
            if($this->currentPage == 1){
                $firstHTML = "<a class='first $button  $disable' href='#'>First</a>";
                $preHTML = "<a class='previous $button  $disable' href='#'>Previous</a>";
                $nextHTML = "<a class='next $button' href='{$href}{$next}'>Next</a>";
                $lastHTML = "<a class='last $button' href='{$href}{$this->totalPage}'>Last</a>";
                $nextNumHTML = "<a class='$button' href='{$href}{$next}'>{$next}</a>";
                $preNumHTML = '';
            }
            elseif($this->currentPage == $this->totalPage){
                $firstHTML = "<a class='first $button' href='{$href}1'>First</a>";
                $preHTML = "<a class='previous $button' href='{$href}{$pre}'>Previous</a>";
                $nextHTML = "<a class='next $button $disable' href='#'>Next</a>";
                $lastHTML = "<a class='last $button $disable' href='#'>Last</a>";
                $nextNumHTML = '';
                $preNumHTML = "<a class='$button' href='{$href}{$pre}'>{$pre}</a>";
            }
            elseif($this->currentPage > 1 && $this->currentPage < $this->totalPage){
                $firstHTML = "<a class='first $button' href='{$href}1'>First</a>";
                $preHTML = "<a class='previous $button' href='{$href}{$pre}'>Previous</a>";
                $nextHTML = "<a class='next $button' href='{$href}{$next}'>Next</a>";
                $lastHTML = "<a class='last $button' href='{$href}{$this->totalPage}'>Last</a>";
                $nextNumHTML = "<a class='$button' href='{$href}{$next}'>{$next}</a>";
                $preNumHTML = "<a class='$button' href='{$href}{$pre}'>{$pre}</a>";
            }
        }


        $html = $firstHTML . $preHTML  .$pre1 .$preNumHTML. $current . $nextNumHTML.$next3 . $nextHTML . $lastHTML;
        return $html;
    }
}