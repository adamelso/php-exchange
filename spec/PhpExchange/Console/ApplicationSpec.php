<?php

namespace spec\PhpExchange\Console;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\Container;

class ApplicationSpec extends ObjectBehavior
{
    function it_is_a_Symfony_Console_Application()
    {
        $this->shouldHaveType('Symfony\Component\Console\Application');
    }

    function it_is_a_container_aware()
    {
        $this->shouldHaveType('Symfony\Component\DependencyInjection\ContainerAwareInterface');
    }

    function it_is_called_PhpEws()
    {
        $this->getName()->shouldReturn('PhpExchange');
    }

    function it_is_versioned()
    {
        $this->getVersion()->shouldNotReturn('UNKNOWN');
    }
}
