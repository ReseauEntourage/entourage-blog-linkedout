FROM wordpress

RUN curl -s https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o /usr/local/bin/wp \
 && chmod +x /usr/local/bin/wp \
 && mkdir ~/.wp-cli \
 && echo allow-root: true >> ~/.wp-cli/config.yml
