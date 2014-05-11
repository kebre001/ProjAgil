#!/bin/bash

#START

TIME=`date +"%b-%d-%y-%H-%M"`             # This Command will add date in Backup File Name.
FILENAME="backup-$TIME.tar"      # Here i define Backup file name format.
SRCDIR="*"                  # Location of Important Data Directory (Source of backup).
DESDIR="/var/www/Demo/sources359/backups/"            # Destination of backup file.

tar -cvf $DESDIR/$FILENAME $SRCDIR

chmod 777 $DESDIR/$FILENAME

#END
