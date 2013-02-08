# php-ltsv
Labelled Tab-Separated Values(LTSV) parser / dumper

## Installation
```bash
git clone git://github.com/t-cyrill/php-ltsv.git
```

## Usage
```php
<?php
require 'autoload.php';

$hash = array('foo' => 'bar');
$ltsv = Ltsv::encode($hash);
Ltsv::decode($ltsv);
```

