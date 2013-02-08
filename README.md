# php-ltsv
Labelled Tab-Separated Values(LTSV) parser / dumper

## Usage
```
<?php
require 'autoload.php';

$hash = array('foo' => 'bar');
$ltsv = Ltsv::encode($hash);
Ltsv::decode($ltsv);
```

