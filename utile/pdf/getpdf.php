<?php
include "../link/linkPdo.php";
include "../function/function.php";
require "pdf.php";
if (!empty($_GET['id'])) {
    pdf($_GET['id']);
}
header("Location: ../../public/detail-reservation.php?id=" . $_GET['id']);
die();
