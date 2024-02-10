# Dynamic DNS

Accessing a local network remotely with a domain, while having a dynamic IP address.  
This method doesn't change DNS records on the domain, it works with IP caching.

> **Why not using a service like noip.com?**  
> With a free membership, you'll receive a monthly email requiring multiple steps of confirmation to continue using the
> service. After a while doing this, this process can become annoying.

## Requirements

- Docker on a local machine
- A domain that points to a webhosting (PHP/MySQL)

## Setup webhosting

1. Setup your domain to point to your webhosting (eg. foo.example.com)
2. Create a database with following table
   ```
   CREATE TABLE `ips` (
      `ip` VARCHAR(15) NOT NULL,
      `date_time` DATETIME NOT NULL
   )
   ```
3. Copy `webhosting/index.php` to the webroot. Replace database values in `$databaseConfig`.

## Setup local machine

1. Clone this project
2. Build the docker container: Run `docker build --tag dynamic-dns .`
3. Create a daily cron job for following command (this caches the dynamic IP)  
   `docker run -e DATABASE_HOST=xx -e DATABASE_USERNAME=xx -e DATABASE_PASSWORD=xx -e DATABASE_NAME=xx dynamic-dns`