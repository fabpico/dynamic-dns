# Dynamic DNS

Access your local machine remotely with a static URL, if you only have a dynamic public IP address.  
The mechanism does not change any DNS records on the static URL, it redirects to the updated IP.

Example: foo.example.com:8000 -> 80.xx.xx.x:8000

> **Why should I use that, compared to a service like noip.com?**
>
> For a free membership, you would receive a monthly email where you have to confirm in multiple steps that you still want to use the free service. If you've been doing this for a year, it just gets annoying.

## Setup remote webhost

1. Create a static URL (eg. foo.example.com)
2. Create a database where the public dynamic IP is being cached
   ```
   CREATE TABLE `ips` (
      `ip` VARCHAR(15) NOT NULL,
      `date_time` DATETIME NOT NULL
   )
   ```
3. Copy `remote/index.php` into the webroot of your static URL, replace database values in `$databaseConfig`.

## Setup local machine

1. Clone this project
2. Install docker
3. Build the docker container: Run `docker build --tag ip-cacher .`
4. Create a daily cron job which will run the IP caching `docker run -e DATABASE_HOST=xx -e DATABASE_USERNAME=xx -e DATABASE_PASSWORD=xx -e DATABASE_NAME=xx ip-cacher`