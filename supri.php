<?php
require_once("inc/config.php");
$req=$bdd->prepare("delete from matiere where id=" . $_GET['id']);
$req->execute();
header('location:news.php');