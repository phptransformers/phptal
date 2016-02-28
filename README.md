# PHPTAL for PHPTransformers

[PHPTAL](http://phptal.org/) support for [PHPTransformers](http://github.com/phptransformers/phptransformer).

## Install

Via Composer

``` bash
$ composer require phptransformers/phptal
```

## Usage

``` php
$engine = new PHPTALTransformer();
echo $engine->render('<tal:block>Hello, ${name}!</tal:block>', array('name' => 'phptransformers'));
```

### Options

``` php
$engine = new PHPTALTransformer(array(
    'cache-dir' => 'path/to/cache/directory', // Default to the system temporary directory
    'template-dir' => 'path/to/template/directory' // default to $PWD
));

// ...

$phptal = new \PHPTAL();
$engine = new PHPTALTransformer(array(
    'phptal' => $phptal // All others options are ignored
));
```

## Testing

``` bash
$ composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.