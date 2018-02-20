WELCOME TO THE CRYPTOKLOUT PROJECT

* - Download all of the files via filezilla, or directly through GIT account
- We are using SourceTree with Atlassian for version control. 

* - download wamp, assuming your using windows. 

* - setup your virtual hosts via this tutorial.
https://john-dugan.com/wamp-vhost-setup/
"C:\wamp\bin\apache\Apache2.2.21\conf\httpd.conf"
- Make sure this file is not commented out in there.
Include conf/extra/httpd-vhosts.conf

Then follow the file you just uncommented
"C:\wamp\bin\apache\Apache2.2.21\conf\extra\httpd-vhosts.conf"
And add the following lines
<VirtualHost *:80>
    ServerName localhost.cryptoklout.com
    DocumentRoot "C:\wamp\www\cryptoklout"
</VirtualHost>

<VirtualHost *:443>
    ServerName localhost.cryptoklout.com
    DocumentRoot "C:\wamp\www\cryptoklout"
</VirtualHost>

<VirtualHost *:80>
    ServerName localhost.api.cryptoklout.com
    DocumentRoot "C:\wamp\www\cryptoklout\api"
</VirtualHost>


* Add some entries to your windows host file
C:\Windows\System32\drivers\etc\hosts
127.0.0.1	localhost.cryptoprophets.io
127.0.0.1	localhost.api.cryptoprophets.io



