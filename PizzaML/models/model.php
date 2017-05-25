<?php
class Model
{
  protected $xml;

  public function __construct()
  {
    $this->loadXML();
  }

  private function loadXML()
  {
    $this->xml = simplexml_load_file("../models/menu.xml");
  }

  public function getPrice($queryArray = array())
  {
    $query = $this->getQuery($queryArray);
    //echo $query;
    return intval($this->xml->xpath($query)[0]);
  }

  private function getQuery($queryArray = array())
  {
    $query = '/menu/' . $queryArray['cartegory'];
    if(array_key_exists('name', $queryArray))
    {
      $query .= '[name="' . $queryArray['name'];
    }
    else if(array_key_exists('with',  $queryArray))
    {
      $query .= '[with="' . $queryArray['with'];
    }

    $query .= '"]/';

    if(array_key_exists('size', $queryArray))
    {
      $query .= $queryArray['size'];
    }
    else if(array_key_exists('price', $queryArray))
    {
      $query .= 'price';
    }

    return $query;
  }

  public function getFood($foodCartegory)
  {

  }
}
?>
