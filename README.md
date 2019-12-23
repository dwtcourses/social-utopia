# social-utopia
A multi-threaded PHP & JS social media application to manage Facebook Pages, Twitter Accounts, LinkedIn Companies and Google My Business Locations

Uses:
- Web Workers

Technologies:
- PHP
- JavaScript
    - Version: ECMAScript 2018
    - jQuery
    - Web Workers

Functionality:
    - Social Media Networks
        - Facebook
        - Twitter
        - Linked In
        - Google My Business
    - Send messages
        - Text
        - Images
        - Links
    - View timeline
    
Composer Libraries
    - "facebook/graph-sdk": "^5.7",
    - "abraham/twitteroauth": "^1.1.0",
    - "google/apiclient": "^2.0",
    - "guzzlehttp/guzzle": "~6.0"

To run composer requests under php 7.3 / plesk 9
    - /opt/plesk/php/7.3/bin/php /usr/lib64/plesk-9.0/composer.phar
    - /opt/plesk/php/7.3/bin/php /usr/lib64/plesk-9.0/composer.phar require guzzlehttp/guzzle
    - /opt/plesk/php/7.3/bin/php /usr/lib64/plesk-9.0/composer.phar require google/apiclient:"^2.0"
    - /opt/plesk/php/7.3/bin/php /usr/lib64/plesk-9.0/composer.phar require facebook/graph-sdk
    - /opt/plesk/php/7.3/bin/php /usr/lib64/plesk-9.0/composer.phar  require abraham/twitteroauth