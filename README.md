![Futurama Screen](logo.png)

# Futurama monorepo

## WTF is this?

All the devices (which I controll) in my home network, get a name from a character in the [Futurama universe](https://futurama.fandom.com/wiki/Futurama_Wiki).
This repository contains scripts for controlling or automating stuff on those devices, usually Raspberry Pi's.

## Rolodex

Character | Purpose
--------- | -------
Nibbler | NAS
Zoidberg | Plex Server
Leela | Plex Client
Fry | Domoticz, Relay API endpoint
Hermes | Intel NUC - Experimental replacment of Zoidberg & Domoticz

## Purpose

My house is dumb and I'm lazy. The ultimate goal is to automate a large portion of my "tasks" in the house so I don't even have to think about these anymore. There is only 1 requirement: everything can still be triggered manually, when the Futurama universe collapses.

## Past realizations

### Automate window blinds

Every morning, at a random time between [sun up - 15mins, sun up + 15mins], the blinds on the ground floor are opened.

Same every evening, but with sun down & closing the blinds.

Used tools:

* [Raspbery Pi Zero W](https://www.kiwi-electronics.nl/raspberry-pi-zero-w?search=raspberry%20pi%20zero%20w&description=true) (Fry)
* [RFXCom](http://www.rfxcom.com/)
* [Domoticz](https://github.com/domoticz/domoticz)

**Quality of life improvement: 4/5**

### Integrate Siri/Homekit

Well.. I have an iphone and it seemed nice to be able to yell at Siri. So I added this capability to Fry. The available blinds from Domoticz are exposed to Homekit, which means I can use my phone to open/close all or some specific blinds. Now I don't have to lift my butt anymore to open/close blinds. Except when the phone is charging...

Used tools:

* [HomeBridge](https://github.com/nfarina/homebridge) (on Fry)
* [HomeBridge eDomoticz plugin](https://www.npmjs.com/package/homebridge-edomoticz)

**Quality of life improvement: 3/5**

## Current tinkering

* Automate light circuits (without connecting 80 LED bulbs to the WiFi)

## Future plans & dreams

* Install a Feed (see [The Murderbot Diaries](http://www.marthawells.com/murderbot.htm)) - Basically, get Kafka running in-house. Maybe on a [k3s](https://k3s.io/) cluster, maybe not. Who knows.. My mind tends to change. Not about the Kafka setup though, the Feed must come.
* Rewire all my Futurama devices to use the Feed (send events to the feed; send commands via the feed; ...)
* Integrate a ZWave presence detector in the garage & link it to the lights there. I always forget to turn off the lights there, only to discover that a couple of hours later.
* Integrate ZWave switch in bedroom to automate the night stand. Not sure how this works with the "must still work manually" mantra. Have to investigate.
* Switch from Domoticz (hello '90s) to [Home Assistant](https://www.home-assistant.io/) (welcome to 2019)
* Integrate sensors to detect if plants need water
* Integrate sensor which detects if snail mail was posted in my mail box
