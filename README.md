![Futurama Screen](logo.png)

# Futurama monorepo

## WTF is this?

All the devices (which I controll) in my home network, get a name from a character in the [Futurama universe](https://futurama.fandom.com/wiki/Futurama_Wiki).
This repository contains scripts for controlling or automating stuff on those devices, usually Raspberry Pi's. 

## Rolodex

Character | Device Type | Purpose
--------- | ----------- | -------
Nibbler | QNAP NAS | Storing & serving my files
Leela | RPi 3B | Rasplex - Plex Client
Fry | RPi Zero W | GPIO MQTT service
Hermes | Intel NUC | Home server

## Purpose

My house is dumb and I'm lazy. The ultimate goal is to automate a large portion of my "tasks" in the house so I don't even have to think about these anymore. There is only 1 requirement: everything can still be triggered manually, when the Futurama universe collapses.

## What's automated at the moment?

### Automate window blinds

Every morning at sun up or 7am, whichever comes first, the blinds on the ground floor are opened.

Same every evening, but with sun down & 8.30pm

Used tools:

* [Intel NUC](https://www.intel.com/content/www/us/en/products/boards-kits/nuc.html) (Hermes)
* [RFXCom](http://www.rfxcom.com/)
* [Home Assistant](https://www.home-assistant.io/)

**Quality of life improvement: 4/5**

### Integrate Siri/Homekit

Well.. I have an iphone and it seemed nice to be able to yell at Siri. So I added this capability to Hermes. The available entities/automations/scenes/... are exposed to Homekit, which means I can use my phone to open/close all or some specific blinds. Now I don't have to lift my butt anymore to open/close blinds. Except when the phone is charging...

Used tools:

* [Home Assistant](https://www.home-assistant.io/)

**Quality of life improvement: 3/5**

### Stop Sonos device when I'm watching Plex

There are 2 things in life which I really like, but don't go well together: Music & Television. I have made an automation which stops the Sonos when I start watching something on Plex. This was a first automation, so it's more a POC. Still, the kids kinda think this is funny.

Used tools:

* [Home Assistant](https://www.home-assistant.io/)

**Quality of life improvement: 2/5**

## Current tinkering

* Installed [pi-mqtt-gpio](https://github.com/flyte/pi-mqtt-gpio) on Fry to controll my light circuits. So far it works, but is a little buggy. Waiting for a new release with `publish_initial: yes` setting to fully integrate this.

## Future plans & dreams

* Integrate the kids Hue night light into Home Assistant and automate the shit out of it
* Rewire the RFXCom stuff to work through MQTT.
* Integrate a Zigbee presence detector in the garage & link it to the lights there. I always forget to turn off the lights there, only to discover that a couple of hours later.
* Same for the cellar and attic actually.
* Integrate Zigbee switch in bedroom to automate the night stand. Not sure how this works with the "must still work manually" mantra. Have to investigate.
* Integrate sensors to detect if plants need water
* Integrate sensor which detects if snail mail was posted in my mail box

## Technical stuff

### Hermes

Hermes is my most trusty employee. He's good at keeping track of everything and without him, Planet Express would be doomed. So who is Hermes, how come he's good at doing what he does and how did he learn it?

At his core, Hermes is an Intel NUC (don't ask which model/year. It was scavenged somewhere) running [Arch Linux](https://www.archlinux.org/). He's provisioned with [Ansible](https://www.ansible.com/) and runs all his services on [Docker](https://www.docker.com/).

Hermes is the love child of Zoidberg (sunsetted) and Fry: he's unified almost all their capabilities and then added extra's.

Services on Hermes:

* [Pihole](https://pi-hole.net/) - Blocks those nasty ads on the internet!
* [Unifi Controller](https://www.ui.com/unifi/unifi-ap/) - Manages my home network
* [Home Assistant](https://www.home-assistant.io/) - Home automation
* [MQTT Broker](https://hub.docker.com/_/eclipse-mosquitto/) - Message broker for IoT devices
* [Plex Server](https://plex.tv) - For all my media consumption

### Fry

Fry learned a while ago that doing more than 1 thing at a time is a recipe for disaster. He used to be the Master Of The Blinds and Keeper Of The Lights, but ended up being too clumsy to handle these two tasks. So Fry was sent to a re-eductation camp and came out a beter person, with a single mind and purpose.

A lightweight Raspberry Pi Zero W makes up the hardware of Fry. He's also running [Arch Linux](https://archlinuxarm.org/) but the ARM version. Provisioning is also done through Ansible.

Services on Fry:

* [Pi-Mqtt-Gpio](https://github.com/flyte/pi-mqtt-gpio) - Exposes GPIO pins on a MQTT broker

### Leela

As a Fate Assignment Officer, Leela wasn't so much fun. But as a Content Delivery Captain, she kicks ass! Leela is in charge of delivering all my media content to my screen.

Leela is a mature Raspberry Pi 3B running [Rasplex](https://github.com/RasPlex/RasPlex) to act as a Plex client. Leela is unique in the Futurama network as she's the last device resisting assimilation through Ansible. Authorities turn a blind eye as she's scheduled to be sunsetted later in 2020.

Services on Leela:

* [Rasplex](https://github.com/RasPlex/RasPlex) - Plex Client

### Nibbler

Don't let his size and cute appearance fool you. Nibbler is older and wiser than the seems. Actually much older. About 10 years old. As befits a good Nibblonian, he gobbles up all the data he can find. Still waiting for that ball of black matter though...

Nibbler is a [QNAP TS-419P+](https://www.qnap.com/en/product/ts-419p+) running 4 [WD Green 2Tb disks](https://www.storagereview.com/review/western-digital-caviar-green-2tb-review-wd20ears) in RAID 6.

He won't admit it, but he's getting old. Data is at risk, with 1 failed disk and 1 disk on the verge of collapsing. After Leela's sunset, Nibbler will be next.
