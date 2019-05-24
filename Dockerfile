FROM centos:centos7

RUN yum install -y epel-release yum-plugin-fastestmirror && \
    echo "include_only=.jp" >>  /etc/yum/pluginconf.d/fastestmirror.conf
RUN yum install  -y\
        unzip \
        vim
RUN sed -i -e 's/^LANG=.*$/LANG=\"ja_JP.UTF-8\"/' /etc/locale.conf && \
    /bin/cp -f /usr/share/zoneinfo/Asia/Tokyo /etc/localtime && \
    rm -fr /usr/share/doc/* /usr/share/man/* /usr/share/groff/* /usr/share/info/* && \
    rm -rf /usr/share/lintian/* /usr/share/linda/* /var/cache/man/* && \
    rm -f /var/lib/rpm/__db* && \
    rm -fr /var/cache/* && \
    rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7
RUN yum -y install \
        httpd-tools \
        httpd
RUN rpm --import http://rpms.famillecollet.com/RPM-GPG-KEY-remi
RUN yum install -y  http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
RUN sed -i '4a priority=1' /etc/yum.repos.d/remi-php72.repo
RUN yum install -y --enablerepo=epel,remi-php72  \
        php-common \
        php-intl \
        php-mcrypt \
        php-pdo \
        php-mbstring \
        php-mysqlnd \
        php-pecl-apcu \
        php-opcache \
        php-pecl-zip \
        php-pear \
        php-process \
        php-xml \
        php-json \
        php-gd \
        php-bcmath \
#        php-fpm \
        php
RUN yum install -y wkhtmltopdf \
        ipa-gothic-fonts ipa-mincho-fonts ipa-pgothic-fonts ipa-pmincho-fonts \
        libXrender libXext
RUN sed -i.bak -e '/^;date.timezone =.*/c date.timezone = Asia\/Tokyo'  \
        -e '/display_errors =.*/c display_errors = Off'  \
        -e '/^expose_php = .*$/c expose_php = Off'  \
        -e '/^;error_log = .*$/c error_log = /dev/stderr' \
        -e '/^error_reporting = .*$/c error_reporting = E_ALL & ~E_DEPRECATED & ~E_NOTICE' \
        -e '/^post_max_size =.*/c post_max_size = 128M'  \
        -e '/^upload_max_filesize =.*/c upload_max_filesize = 128M'  \
        -e '/^;mbstring.language =.*/c mbstring.language = Japanese' \
        -e '/^;mbstring.internal_encoding =.*/c mbstring.internal_encoding = UTF-8' \
        -e '/^;mbstring.http_input =.*/c mbstring.http_input = pass'  \
        -e '/^;mbstring.http_output =.*/c mbstring.http_output = pass' \
        /etc/php.ini ;
RUN rm -fr /usr/share/doc/* /usr/share/man/* /usr/share/groff/* /usr/share/info/* && \
    rm -rf /usr/share/lintian/* /usr/share/linda/* /var/cache/man/* && \
    rm -f /var/lib/rpm/__db* && \
    rpm --rebuilddb && \
    yum clean all && \
    rm -fr /var/cache/*

# php composer setup
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -f composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

# sassを使えるようにする
RUN yum -y install git make autoconf curl wget
RUN yum install -y openssl-devel readline-devel zlib-devel
RUN yum groupinstall -y "Development tools"

# install rbenv
RUN git clone https://github.com/rbenv/rbenv.git /root/.rbenv
ENV PATH /root/.rbenv/bin:$PATH
ENV PATH /root/.rbenv/shims:$PATH

# install ruby-build
RUN git clone https://github.com/sstephenson/ruby-build.git root/.rbenv/plugins/ruby-build

# install ruby
RUN rbenv install 2.5.5 && rbenv global 2.5.5

RUN gem install compass && \
    gem install sass && \
    gem install sass-globbing

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
ENV LANG ja_JP.UTF-8


# 設定関係のファイル設置
ADD config/httpd.conf /etc/httpd/conf/httpd.conf
ADD config/exec.sh /usr/local/bin/exec.sh
ADD config/.bashrc /root/.bashrc
ADD html /var/www/html

RUN chmod +x /usr/local/bin/exec.sh

WORKDIR /var/www/html
CMD ["/usr/local/bin/exec.sh"]