<?php
header("connection: close");
if (!empty($_GET['flags'])) {
    header("content-type: image/svg+xml");
    readfile("flags/" . $_GET['flags'] . ".svg");
} else {
    include_once "index.html";
}
