<?php

class Entry
{
  /**
   * @var string
   */
  private $title;
 
  /**
   * @var string
   */
  private $description;
 
  /**
   * @var string
   */  
  private $entry_time;
 
  /**
   * @var string
   */
  private $observations;
 

  public function __construct($title, $desc, $obs = null)
  {
    $title = str_replace("'","''",$title);
    $desc  = str_replace("'","''",$desc);
    $obs   = str_replace("'","''",$obs);
    $this->title        = $title;
    $this->description  = $desc;
    $this->observations = $obs;
    $this->entry_time   = date("Y-m-d H:i:s");
  }

  /**
   * Get the value of title
   *
   * @return  string
   */ 
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Get the value of description
   *
   * @return  string
   */ 
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Get the value of entry_time
   */ 
  public function getEntry_time()
  {
    return $this->entry_time;
  }

  /**
   * Get the value of observations
   *
   * @return  string
   */ 
  public function getObservations()
  {
    return $this->observations;
  }

}