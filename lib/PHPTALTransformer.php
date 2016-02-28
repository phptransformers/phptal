<?php

namespace PhpTransformers\PHPTAL;

use PhpTransformers\PhpTransformer\TransformerInterface;

/**
 * Class PHPTALTransformer.
 *
 * The PhpTransformer for PHPTAL template engine.
 * {@link http://phptal.org/}
 *
 * @author  MacFJA
 * @package PhpTransformers\PHPTAL
 * @license MIT
 */
class PHPTALTransformer implements TransformerInterface
{
    /** @var \PHPTAL */
    protected $phptal;

    /**
     * Build the PHPTAL engine.
     *
     * @param array $options An array of parameters used to set up the PHPTAL configuration.
     *                       Available configuration values include:
     *                       - phptal
     *                       - cache-dir
     *                       - template-dir
     */
    public function __construct(array $options = array())
    {
        if (array_key_exists('phptal', $options)) {
            $this->phptal = $options['phptal'];
            return;
        }
            $this->phptal = new \PHPTAL();

        if (array_key_exists('cache-dir', $options)) {
            $this->phptal->setPhpCodeDestination($options['cache-dir']);
        }

        if (array_key_exists('template-dir', $options)) {
            $this->phptal->setTemplateRepository($options['template-dir']);
        }
    }

    public function getName()
    {
        return 'phptal';
    }

    public function renderFile($file, array $locals = array())
    {
        $engine = clone $this->phptal;
        foreach ($locals as $name => $value) {
            $engine->set($name, $value);
        }
        $engine->setTemplate($file);
        return $engine->execute();
    }

    public function render($template, array $locals = array())
    {
        $engine = clone $this->phptal;
        foreach ($locals as $name => $value) {
            $engine->set($name, $value);
        }
        $engine->setSource($template);
        return $engine->execute();
    }
}
