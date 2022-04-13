FROM bytemark/smtp:latest

RUN apt-get update
RUN apt-get install mysql-server -y
RUN apt-get install curl -y
RUN apt-get install jq -y
RUN apt-get -y install -qq --force-yes cron
COPY src /root/
RUN chmod +x /root/script.sh
RUN chmod 0744 /root/script.sh
RUN touch /var/log/script.log
COPY time-cron /etc/cron.d/time-cron
RUN chmod 0644 /etc/cron.d/time-cron
RUN crontab /etc/cron.d/time-cron
EXPOSE 25/tcp
