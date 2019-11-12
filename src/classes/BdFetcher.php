<?php

require_once "Entry.php";
require_once "Connection.php";

class BdFetcher
{

  public function fetchAll()
  {
    $connection = new Connection();
    $query = "SELECT * FROM todo" .
    " WHERE archived='N'" .
    " ORDER BY entry_time DESC";;
    $fetch = pg_query($connection->connect(),$query);
    $result = pg_fetch_all($fetch);
    if (!$result) {
      return null;
    } else {
      return $result;
    }
    $connection->disconnect();
  }

  public function fetchAllArchived()
  {
    $connection = new Connection();
    $query = "SELECT * FROM todo" .
    " WHERE archived='Y'" .
    " ORDER BY entry_time DESC";
    $fetch = pg_query($connection->connect(),$query);
    $result = pg_fetch_all($fetch);
    if (!$result) {
      return null;
    } else {
      return $result;
    }
    $connection->disconnect();
  }

  public function fetchRow($id)
  {
    $connection = new Connection();
    $query = "SELECT * FROM todo WHERE id=" .
    (int) $id . " AND " . "archived='N'" .
    " ORDER BY entry_time DESC";
    $fetch = pg_query($connection->connect(),$query);
    $result = pg_fetch_assoc($fetch);
    if (!$result) {
      return null;
    } else {
      return $result;
    }
    $connection->disconnect();
  }

  public function insert($obj)
  {
    $connection = new Connection();
    if ($obj->getTitle() == '') {
      $obj->setTitle(null);
    }
    if ($obj->getDescription() == '') {
      $obj->setDescription(null);
    }
    $query = "INSERT INTO todo (
      title, description, entry_time, observations, archived, edited)
      VALUES (
        '"  . $obj->getTitle()        . "'," .
        "'" . $obj->getDescription()  . "'," .
        "'" . $obj->getEntry_time()   . "'," .
        "'" . $obj->getObservations() . "'," .
        "'N', 'N')";
    $result = pg_query($connection->connect(),$query);
    if (!$result) {
      echo "An error occurred, try again.";
    }
    $connection->disconnect();
  }

  public function delete($id)
  {
    $connection = new Connection();

    $query = "DELETE FROM todo WHERE id=" . (int) $id;
    $result = pg_query($connection->connect(),$query);

    if (!$result) {
      echo "Something went wrong, try again.";
    } 

    $connection->disconnect();
  }

  public function edit($id, $title, $description, $observations)
  {
    $title = str_replace("'", "''", $title);
    $description = str_replace("'", "''", $description);
    $observations = str_replace("'", "''", $observations);
    $connection = new Connection();
    $edit_time = date("Y-m-d H:i:s");
    $query = "UPDATE todo SET " .
      "title='" . $title . "'," .
      "description='" . $description . "'," .
      "observations='" . $observations . "'," .
      "edited='Y', edit_time='" . $edit_time . "' " .
      "WHERE id=" . (int) $id . " AND " .
      "archived='N'";
    $result = pg_query($connection->connect(),$query);
    return $result;

    $connection->disconnect();
  }

  public function archive($id)
  {
    $connection = new Connection();

    $query = "UPDATE todo SET " .
      "archived='Y'" .
      "WHERE id=" . (int) $id;
    $result = pg_query($connection->connect(),$query);
    return $result;

    $connection->disconnect();
  }

  public function unarchive($id)
  {
    $connection = new Connection();

    $query = "UPDATE todo SET " .
      "archived='N'" .
      "WHERE id=" . (int) $id;
    pg_query($connection->connect(),$query);
    
    $connection->disconnect();
  }
}