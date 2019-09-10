# Seebeez PHP

[![Build Status](https://travis-ci.com/seebeez/seebeez-php.svg?branch=master)](https://travis-ci.com/seebeez/seebeez-php)
[![Coverage Status](https://coveralls.io/repos/github/seebeez/seebeez-php/badge.svg?branch=master)](https://coveralls.io/github/seebeez/seebeez-php?branch=master)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/ab4eb13f117c41f190a1a6d915935921)](https://www.codacy.com/manual/kazilotus/seebeez-php?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seebeez/seebeez-php&amp;utm_campaign=Badge_Grade)

Seebeez is a super fast transcoding service made for developers for converting all types of file formats.

## Contents

-  [Requirements](#requirements)
-  [Installation](#installation)
-  [Quick-start](#quick-start)

## Requirements

This package requires you to have PHP version 7.0+ installed.

## Installation

Install [Composer](https://getcomposer.org/download/) and get the following package

```sh
$ composer require seebeez/seebeez-php
```

## Quick Start

Seebeez first fetches the file of the provided **format** from the **source** and exports the file to your storage based on the **export** link. You can also specify the **codec** you want to use on the provided file **format**. You can implicitly set the **server** type of your job instance.

Please note that, you need obtain an [API TOKEN](https://seebeez.com/api) to use this library.
```php
use "SeebeezPHP\Seebeez"


```
