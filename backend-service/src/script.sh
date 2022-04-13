#!/bin/bash
# find local time zone
timezone=$(cat /etc/timezone)

# find local time
function get_local_time () {
    localtime=($(date +"%Y-%m-%dT%H:%M"))
    echo $localtime
}

# retrieve time from worldtimeapi.org
function get_from_worldtimeapi () {
   realtime=($(curl -s "http://worldtimeapi.org/api/timezone/${timezone}" | jq -r '."datetime"' | awk -F: '{print $1,$2}' OFS=":"))
   if [ $? -ne "0" ]; then
        echo "Unable to reach worldtimeapi server" | mail -s "tto-timesync-error"  ruweeniddagoda@gmail.com
   fi 
   echo $realtime
}

# main func - compare times and insert to database
function compare_times () {
    if [ $x_time = $y_time ]; then
         result=$(mysql -u ${MYSQL_USER} -h ${MYSQL_HOSTNAME} -p${MYSQL_PASS} mydb -P 3306 -e "INSERT INTO myclocks (LTIME, RTIME, STATUS) VALUES ('${x_time}', '${y_time}', 'CORRECT')" 2>&1)
         if [ $? -ne "0" ]; then
            echo $result | mail -s "tto-timesync-error"  ruweeniddagoda@gmail.com
         fi   
    else
        result=$(mysql -u ${MYSQL_USER} -h ${MYSQL_HOSTNAME} -p${MYSQL_PASS} mydb -P 3306 -e "INSERT INTO myclocks (LTIME, RTIME, STATUS) VALUES ('${x_time}', '${y_time}', 'WRONG')" 2>&1)
        if [ $? -ne "0" ]; then
            echo $result | mail -s "tto-timesync-error"  ruweeniddagoda@gmail.com
        fi  
    fi
}

x_time=($(get_local_time))
y_time=($(get_from_worldtimeapi))
compare_times