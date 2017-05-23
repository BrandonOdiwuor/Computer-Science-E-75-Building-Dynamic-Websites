<?php
class Model
{
  protected $xml;
  protected function loadXML()
  {
    $this->xml = simplexml_load_file("menu.xml");
  }

}
?>
