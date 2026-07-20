<?php
include_once "./include/link.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // The client sends article_id; use the same field name here.
    $id     = isset($_POST['article_id']) ? (int) $_POST['article_id'] : 0;
    $action = $_POST['action'] ?? '';

    // Allow only valid column names
    if ($id > 0 && in_array($action, ['view', 'download'])) {

        if ($functions->updateArticle($id, $action)) {
            echo 'success';
        } else {
            echo 'failed';
        }

    } else {
        echo 'invalid';
    }

    exit;
}

echo 'invalid request';
