memetor
=======

PHP MEdia MEtadata extracTOR library

[![Build Status](https://travis-ci.org/pdenis/memetor.png)](https://travis-ci.org/pdenis/memetor)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/pdenis/memetor/badges/quality-score.png?s=b95ac82d6d86a20c064d8c2bbd524f780470e734)](https://scrutinizer-ci.com/g/pdenis/memetor/)
[![Code Coverage](https://scrutinizer-ci.com/g/pdenis/memetor/badges/coverage.png?s=96d61622af7905d30ad346e8b4cec34c3fb747a4)](https://scrutinizer-ci.com/g/pdenis/memetor/)


## Installation

### Installation by Composer

If you use composer, add memetor library as a dependency to the composer.json of your application

```php
    "require": {
        ...
        "snide/memetor": "dev-master"
        ...
    },

```

## Usage

### Extract ALL

```php
<?php
    include_once('vendor/autoload.php');

    $media = new Image('path/to/your/image.jpg');

    $extractor = new Snide\Memetor\Image\Extractor\ExifExtractor($this->media);
    $extractor = new Snide\Memetor\Image\Extractor\XmpExtractor($extractor);
    $extractor = new Snide\Memetor\Image\Extractor\IptcExtractor($extractor);

    $metadata = $extractor->getMetadata() // Exif, Iptc, XMP metadata

```

That's all!