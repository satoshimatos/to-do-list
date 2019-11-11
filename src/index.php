<?php

require_once "classes/Entry.php";
require_once "classes/BdFetcher.php";

if (isset($_POST['submit'])) {
  $newEntry = new Entry($_POST['title'], $_POST['desc'], $_POST['comments']);
  $fetcher = new BdFetcher();
  $fetcher->insert($newEntry);
}

if (isset($_POST['delete_entry'])) {
  BdFetcher::delete($_POST['id']);
}

if (isset($_POST['edit'])) {
  BdFetcher::edit($_POST['id'], $_POST['title'], $_POST['desc'], $_POST['comments']);
}

if (isset($_POST['archive'])) {
  BdFetcher::archive($_POST['id']);
}

if (isset($_POST['unarchive'])) {
  BdFetcher::unarchive($_POST['id']);
}

require "../view/main.phtml";