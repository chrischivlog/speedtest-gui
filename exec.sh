#!/bin/bash
d=$(date +%y%m%d%H%M%S)

sudo speedtest -f json > /var/www/html/log/log-$d.json