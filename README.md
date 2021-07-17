# unms-telegram-notifications
Simple PHP script to push new events from UNMS (Ubiquiti Network Management System) API to a Telegram Chat

This is first version of my script to push UNMS (Ubiquiti Network Management System) events to our WISP's Telegram Channel. In the future versions there will be code revisions and developments to see more details and take actions about pushed events. It's free to use and distribute.

## Prerequisites
- Php-Cli and Php-Curl to execute script
- Cron Service to schedule script
- UNMS (Ubiquiti Network Management System) API Token (Please follow "Settings > Users > API tokens > Create new API token" to create a token on your UNMS if you don't have)
- Telegram Bot Api Key and Chat Id

## Installation
- Download the code on a path on your server (please change crontab list regarding to it)
- Change the temporary cache file path if needed on $LastResponse value
- Change <YOUR_UNMS_URL> with yours on code
- Change <YOUR_UNMS_API_TOKEN> with yours on code
- Change <TELEGROM_BOT_API_KEY> with yours on code
- Change <TELEGRAM_CHAT_ID> with yours on code



## Crontab List

You can set it based on your requirements. To get new UNMS events every minute it's enough to have first line in your crontab list. Or you can add all to get it every 10 seconds.

```
* * * * * /usr/bin/php7.2 /root/UnmsToTelegram.php
* * * * * sleep 10; /usr/bin/php7.2 /root/UnmsToTelegram.php
* * * * * sleep 20; /usr/bin/php7.2 /root/UnmsToTelegram.php
* * * * * sleep 30; /usr/bin/php7.2 /root/UnmsToTelegram.php
* * * * * sleep 40; /usr/bin/php7.2 /root/UnmsToTelegram.php
* * * * * sleep 50; /usr/bin/php7.2 /root/UnmsToTelegram.php
```

## Donations

Donations are greatly appreciated and a motivation to keep improving.

- BTC: bc1quttuhyt32glct66whyllg3rf9kfu36g9d2kc37
- ETH: 0x53Aa03cB68EB2A3361E9fE9e5DbECd68763EcD40
- LTC: ltc1qr0f4f2fvh705ewqaqhwhjwxgwtgwdm8p35n6xw
