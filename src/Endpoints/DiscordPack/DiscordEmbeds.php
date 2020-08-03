<?php

namespace nhalstead\Endpoints\DiscordPack;

use nhalstead\Request\Object;
use nhalstead\Interfaces\ObjectImp;

/**
 * Discord Event
 *
 * @parent nhalstead\Request\Event
 * @link https://discordapp.com/developers/docs/resources/channel#embed-object
 */
class DiscordEmbeds extends Object implements ObjectImp {

  public $payloadBase = [
    'title' => '', // [256]
    'type' => '', // type of embed (always "rich" for webhook embeds) [2048]
    'description' => '', // description of embed
    'url' => '',
    'timestamp' => "", // Type: ISO8601 timestamp, timestamp of embed content, date('c')
    /*'color' => 0,*/

    // objects, Single Element
    'footer' => null,
    'image' => null,
    'thumbnail' => null,
    'video' => null,
    'provider' => null,
    'author' => null,
    'fields' => array() // [25]
  ];

  private $objects = [
    'footer' => [
      "text" => "",
      "icon_url" => "",
      "proxy_icon_url" => ""
    ],
    'image' => [
      "url" => "",
      "proxy_url" => "",
      "height" => 0,
      "width" => 0
    ],
    'thumbnail' => [
      "id" => "", // Type: Snowflake, attachment id
      "filename" => "", // name of file attached
      "size" => 0, // size of file in bytes
      "url" => "", // source url of file
      "proxy_url" => "", //	a proxied url of file
      "height" => 0,
      "width" => 0
    ],
    'video' => [
      "url" => "",
      "height" => 0,
      "width" => 0
    ],
    'provider' => [
      "name" => "",
      "url" => ""
    ],
    'author' => [
      "name" => "",
      "url" => "",
      "icon_url" => "",
      "proxy_icon_url" => ""
    ],
    'fields' => [
      "name" => "",
      "value" => "",
      "inline" => false
    ],
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

  /**
   * Add Attachment to the Payload
   *
   * @param nhalstead\Interfaces\ObjectImp Event Payload
   */
  public function addEmbed($name, ObjectImp $e){
    $this->payload[$name] = $e->get_payload();
    return $this;
  }


}

?>
