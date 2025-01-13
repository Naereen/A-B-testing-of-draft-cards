# Quick Makefile to send the path to zamok
SHELL=/usr/bin/env /bin/bash

all:	send

send:	send_zamok
send_zamok:
	CP --exclude=.git ./ ${Szam}publis/A-B-testing-of-draft-cards/
