<?php
class Food
{
  private $xml;

  public function __construct()
  {
    $this->loadMenuXML();
  }

  private function loadMenuXML()
  {
    $path = $_SERVER["DOCUMENT_ROOT"] . "/PizzaML/models/menu.xml";
    $this->xml = simplexml_load_file($path);
  }

  public function cartegories()
  {
    $query = '/menu/cartegories/cartegory/name';
    $cartegories = $this->runQuery($query);
    return $cartegories;
  }

  public function index($cartegory)
  {
    $query = sprintf('/menu/item[cartegory="%s"]', $cartegory);
    $food = $this->runQuery($query);
    return $food;
  }

  public function order_detail($id)
  {
    $query = sprintf('/menu/item[@id="%d"]', $id);
    $food = $this->runQuery($query)[0];
    return $food;
  }

  public function price($id)
  {
    $query = sprintf('/menu/item[@id="%d"]/price', $id);
    $price = $this->runQuery($query)[0];
    return intval($price);
  }

  public function name($id)
  {
    $query = sprintf('/menu/item[@id="%d"]/name', $id);
    $name = $this->runQuery($query)[0];
    return $name;
  }

  private function runQuery($query)
  {
    return $this->xml->xpath($query);
  }
}
?>
