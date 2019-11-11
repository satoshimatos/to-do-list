<?php

class Connection
{

  private $connection;

  public function __construct()
  {
    $this->connection = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin123");
  }

  public function connect()
  {
    return $this->connection;
  }

  public function disconnect()
  {
    $this->connection = null;
  }
}