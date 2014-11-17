geocoder-cacher
====================

PHP script returning gps coordinates after geocoding a certain Country+City combination. In order to save up calls to the Geocoder API, results are cached as text files.

# Supported Geocoding services

* Mapquest

# Installation

First you need to register for a Mapquest API under http://www.mapquestapi.com/geocoding/

1. Rename config_sample.php to config.php and specify Mapquest API credentials.
2. Deploy PHP files on a webserver of your choice.

# How to use

Client has to GET-Request the geocoder_cacher.php file setting the **location** parameter with <country>+<city>, example:

```
GET http://server/geocoder_cacher.php?location=Germany+Berlin
```

The script will return the coordinates in plain-text format as <longitude>,<latitude>, example:

```
13.4061,52.5192
```

# Used in

https://github.com/acorbi/ok-directory-public
