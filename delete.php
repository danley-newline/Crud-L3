<?php
require_once("inc/config.php");
$req=$bdd->prepare("delete from users where id=" . $_GET['id']);
$req->execute();
header('location:index.php');