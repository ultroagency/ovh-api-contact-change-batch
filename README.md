#  Change domains name OVH contact

Manage contact for domain names on OVH provider

## Installation

Use PHP [Composer](https://getcomposer.org) :

```bash
composer install
```

## Generate keys

Generate Script Keys : [OVH API credentials](https://api.ovh.com/createToken/index.cgi?GET=/*&PUT=/*&POST=/*&DELETE=/*)

## Create CSV file

Create a CSV file with ID and confirmation token received by email : id,token

Download all confirmation emails (eml or txt format)
Bash command line to parse them:

```bash
cat *.eml | grep "https://www.ovh.com/manager/\#/useraccount/contacts" | cut -d"/" -f8 | sed "s/?tab=REQUESTS&token=/,/g" > tokens.csv
```

See tokens.csv example.

## Usage

```bash
php -S localhost:8000
```

Got to http://localhost:8000/accept-changes.php

## Custom usage

See https://api.ovh.com/console/


