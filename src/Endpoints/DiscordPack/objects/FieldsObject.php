<?php

namespace nhalstead\Endpoints\DiscordPack\objects;

use nhalstead\Request\Object;
use nhalstead\Interfaces\ObjectImp;

/**
 * Discord Event
 *
 * @parent nhalstead\Request\Event
 * @link https://discordapp.com/developers/docs/resources/channel#embed-object
 */
class FieldsObject extends Object implements ObjectImp {

  protected $payloadBase = [

  ];

  protected $element = [
    "name" => "",
    "value" => "",
    "inline" => false
  ];

  public function add(array $in){
    $t = array_merge($this->element, $in);
    $this->payload[] = $t;
    return $this;
  }

  /**
   * Set Function, To Define The Params
   *
   * @param String The Value to Set
   * @param Mixed The Value
   */
  public function set($key, $value){
    $this->payload[ $key ] = $value;
    return $this;
  }


}

?>
