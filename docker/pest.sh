#!/bin/sh
docker run -it --rm -v ${PWD}:/var/app/notifier app:notifier pest --coverage