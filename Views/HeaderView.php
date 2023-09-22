<!DOCTYPE html>
<?php
$color = "";
if (strpos($_SERVER['QUERY_STRING'], 'home') || strpos($_SERVER['QUERY_STRING'], 'controle')) {
  $color = "#00000ed1";
} 
?>
<html lang="pt-br" style="background-color:<?= $color ?>;">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galax Pay API</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<header>

</header>

<body class="">