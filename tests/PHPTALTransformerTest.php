<?php

namespace PhpTransformers\PHPTAL\Test;

use PhpTransformers\PHPTAL\PHPTALTransformer;

class PHPTALTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function testRenderFile()
    {
        $engine = new PHPTALTransformer();
        $template = 'tests/Fixtures/PHPTALTransformer.xhtml';
        $locals = array(
            'name' => 'Linus',
        );
        $actual = $engine->renderFile($template, $locals);
        self::assertEquals('Hello, Linus!', $actual);
    }

    public function testRender()
    {
        $engine = new PHPTALTransformer();
        $template = file_get_contents('tests/Fixtures/PHPTALTransformer.xhtml');
        $locals = array(
            'name' => 'Linus',
        );
        $actual = $engine->render($template, $locals);
        self::assertEquals('Hello, Linus!', $actual);
    }

    public function testGetName()
    {
        $engine = new PHPTALTransformer();
        self::assertEquals('phptal', $engine->getName());
    }

    public function testTemplateDir()
    {
        $engine = new PHPTALTransformer(array(
            'template-dir' => __DIR__.DIRECTORY_SEPARATOR.'Fixtures'
        ));
        $template = 'PHPTALTransformer.xhtml';
        $locals = array(
            'name' => 'Linus',
        );
        $actual = $engine->renderFile($template, $locals);
        self::assertEquals('Hello, Linus!', $actual);
    }

    public function testConstructor()
    {
        $engine = new \PHPTAL();
        $engine->setTemplateRepository(__DIR__.DIRECTORY_SEPARATOR.'Fixtures');
        $engine->set('name', 'Linus');
        $engine = new PHPTALTransformer(array(
            'phptal' => $engine
        ));
        $template = 'PHPTALTransformer.xhtml';
        $locals = array();
        $actual = $engine->renderFile($template, $locals);
        self::assertEquals('Hello, Linus!', $actual);
    }

    public function testCacheDir()
    {
        $engine = new PHPTALTransformer(array(
            'cache-dir' => sys_get_temp_dir()
        ));
        $template = 'tests/Fixtures/PHPTALTransformer.xhtml';
        $locals = array(
            'name' => 'Linus',
        );
        $actual = $engine->renderFile($template, $locals);
        self::assertEquals('Hello, Linus!', $actual);
    }
}
