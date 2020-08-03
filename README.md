# PHP Webhook Facilitator

Using the Basic Package you can Post Requests to Slack, Discord and other Services that have WebHook Endpoints with Ease!

This is a package for PHP, So it is PSR4 compliant and can be used with or without composer.

**Zero** Dependencies with exception of `CURL`.

The System is even ready for you to add you own Custom Webhook Endpoints.

## Supported Services
| Name          | Full Support |               Class                |
|:--------------|:------------:|:----------------------------------:|
| Custom Events |     Yes      |                                    |
| Slack         |     Yes      |  nhalstead\Endpoints\SlackWebhook  |
| Discord       |     Yes      | nhalstead\Endpoints\DiscordWebhook |
| IFTTT         |     Yes      |  nhalstead\Endpoints\IFTTTWebhook  |

---

## Installation
You can install the package via composer
>```bash
>composer require nhalstead/php-facilitator
>```
Alternatively you can clone the code from GitHub
>```bash
>git clone https://github.com/nhalstead/php-facilitator.git
>```

## How to use:
> Load the Package using Composer
>```php
>```php
>>require_once("../vendor/autoload.php"); // Composer Method, Loading by PSR4
>>use nhalstead\Facilitator\Facilitator;
>>```
>```


> This will send an Payload to a Specific channel on the specified event.
>```php
>use nhalstead\Facilitator\Facilitator;
>use nhalstead\Facilitator\Endpoints\DiscordWebhook;
>
> // Create new Queue
>$queue = new Facilitator();
>
>// Make new Event
>$newEvent = new DiscordWebhook("[DISCORD WEBHOOK URL]");
>$newEvent->username("John");
>$newEvent->avatar("https://png.icons8.com/clouds/50/000000/megaphone.png");
>$newEvent->message("Hello");
>
>
>// Add and Send Events in Queue
>$queue->addEvent($newEvent);
>$queue->sendEvents();
>```
> For more Examples check out the /examples folder.


## Contributors
- nhalstead @ https://github.com/nhalstead
