<?php
function route($view) {
    // Sanitize the view name to prevent directory traversal attacks
    $view = preg_replace('/[^a-zA-Z0-9_\-\/]/', '', $view);

    // Construct the full path to the view file
    $viewPath = VIEW_PATH . $view . '.php';


    if (file_exists($viewPath)) {
        require_once $viewPath;
    } else {

        echo "View not found: " . htmlspecialchars($view);
    }
}
