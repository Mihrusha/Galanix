<?php

namespace App\Controller;

use App\Model\Model;
use App\View\View;

class Controller
{
    private $view;
    private $model;
    public function __construct()
    {
        $this->view = new View;
        $this->model = new Model;
    }

    public function ShowDownload()
    {
        if (isset($_POST['submit'])) {
            $result = $this->model->Upload();

            $this->model->ReadFile($result);
        }

        if (isset($_POST['delete'])) {
            $this->model->CleanTable();
        }
        $this->view->First();
    }

  
}
