<?php

function renderComponent($component, $variables = []) {
    extract($variables);
    $componentPath = __DIR__ . '/../views/components/' . $component . '.php';
    include_once($componentPath);
}