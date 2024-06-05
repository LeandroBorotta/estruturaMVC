<?php
function route($view) {

    $view = preg_replace('/[^a-zA-Z0-9_\-\/]/', '', $view);


    $viewPath = VIEW_PATH . $view . '.php';


    if (file_exists($viewPath)) {
        require_once $viewPath;
    } else {

        echo "View not found: " . htmlspecialchars($view);
    }
}
