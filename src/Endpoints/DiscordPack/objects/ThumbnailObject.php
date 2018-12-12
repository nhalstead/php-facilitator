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
class ThumbnailObject extends Object implements ObjectImp {

  protected $payloadBase = [
    "id" => "", // Type: Snowflake, attachment id
    "filename" => "", // name of file attached
    "size" => 0, // size of file in bytes
    "url" => "", // source url of file
    "proxy_url" => "", //	a proxied url of file
    "height" => 0,
    "width" => 0
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
