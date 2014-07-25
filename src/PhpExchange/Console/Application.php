<?php

namespace PhpExchange\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Yaml\Yaml;

class Application extends BaseApplication implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    const NAME = 'PhpExchange';

    const VERSION = '0.0.1-DEV';

    /**
     * @var array|null
     */
    private $parameters;

    public function __construct()
    {
        parent::__construct(self::NAME, self::VERSION);

        $this->addCommands([
            new Command\ConnectCommand(),
        ]);
    }

    /**
     * @return array
     *
     * @throws \RuntimeException
     */
    public function getParameters()
    {
        if (!$this->parameters) {
            $this->loadParameters();
        }

        return $this->parameters;
    }

    private function loadParameters()
    {
        $parameters = @file_get_contents(__DIR__ . '/../../../config/parameters.yml');

        if (!$parameters) {
            throw new \RuntimeException("Could not load YAML file");
        }

        $data = Yaml::parse($parameters);

        if (!isset($data['parameters'])) {
            throw new \RuntimeException("`parameters` key not defined in YAML configuration");
        }

        $this->parameters = $data['parameters'];
    }
}
