<?php

class BackEndController extends BaseController
{

    // лейаут
    public $layout = 'application';
        
    // меню
    public $menu = array();
    
    // крошки
    public $breadcrumbs = array();
    
    
    /*
        Фильтры
    */
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
}
