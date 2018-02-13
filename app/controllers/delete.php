<?php

/**
 * summary
 */
class Delete extends Controller
{
    public function summ($id)
    {
    	//зделать запрос проверки , кассир с той домашки или нет - где такой id суммы
    	
    	$this->model->deletePaid($id);
    	header('Location: '. URL . '/');
        die();
    }
}
