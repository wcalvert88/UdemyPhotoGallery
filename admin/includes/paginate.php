<?php 
class Paginate {
    public $current_page;
    public $items_per_page;
    public $items_total_count;

    public function __construct($current_page = 1, $items_per_page=4, $items_total_count=0) {
        $this->current_page = (int)$current_page;
        $this->items_per_page = (int)$items_per_page;
        $this->items_total_count = (int)$items_total_count;
    } // End __construct Method

    public function next() {
        return $this->current_page + 1;
    } // End Next Method

    public function previous() {
        return $this->current_page - 1;
    } // End Previous Method

    public function page_total() {
        return ceil($this->items_total_count / $this->items_per_page);
    } // End page_total method

    public function has_previous() {
        return $this->previous() >= 1 ? true : false;
    } // End has_previous method

    public function has_next() {
        return $this->next() <= $this->page_total() ? true : false;
    } // End has_next method;

    public function offset() {
        return ($this->current_page - 1) * $this->items_per_page;
    } // End offset method
} // End Class Paginate











?>