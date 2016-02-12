<?php

    /**
    * load view class
    * @global Object $view
    */
    $view = new Philo\Blade\Blade(config('path.themes').'/'.config('app.theme'), config('path.storages').'/cache/views');
    $view = $view->view();