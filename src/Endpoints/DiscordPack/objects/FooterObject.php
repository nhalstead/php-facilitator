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
class FooterObject extends Object implements ObjectImp {

  protected $payloadBase = [
    "text" => "",
    "icon_url" => "",
    "proxy_icon_url" => ""
  ];

  /**
   * Set Function, To Define The Params
   *
   * @param String The Value to Set
   * @param Mixed The Value
   */
  function set($key, $value){
    $this->payload[ $key ] = $value;
    return $this;
  }


}

?>
