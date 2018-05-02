<?php 
class Paginate {
    public $current_page;
    public $items_per_page;
    public $items_total_count;

    public function __construct($current_page = 1, $items_per_page=4, $items_total_count=0) {
        $this->current_page = (int)$page;
        $this->items_per_page = (int)$items_per_page;
        $this->items_total_count = (int)$items_total_count;
    } // End __construct method

} // End Class Paginate











?>