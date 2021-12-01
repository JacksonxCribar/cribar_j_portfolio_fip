FROM centos:7

# update package lists & install utils
RUN yum update -y \
  && yum install -y epel-release yum-utils

# install all Apache and PHP
RUN yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm \
  && yum-config-manager --enable remi-php81 \
  && yum install -y httpd software-properties-common \
  && yum install -y php php-fpm php-json

# install SSMTP
RUN yum install -y ssmtp \
  && echo -e "mailhub=fip_email:25\nUseTLS=NO\nFromLineOverride=YES\n" > /etc/ssmtp/ssmtp.conf

# create php run paths
RUN mkdir -p /run/php \
  && mkdir -p /run/php-fpm

# set PHP timezone
RUN echo -e "date.timezone=America/Toronto\n" > /etc/php.d/99-timezone.ini

# set default HTTPD site to AllowOverride All
COPY default_site.conf /etc/httpd/conf.d/default_site.conf

# redirect HTTPD access and error logs
RUN ln -sf /dev/stdout /var/log/httpd/access_log \
  && ln -sf /dev/stderr /var/log/httpd/error_log

# https://httpd.apache.org/docs/2.4/stopping.html#gracefulstop
STOPSIGNAL SIGWINCH

EXPOSE 80

CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
