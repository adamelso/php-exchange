<?php

namespace spec\PhpExchange;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AccountClientSpec extends ObjectBehavior
{
    function let()
    {
        $domain = '';
        $username = '';
        $password = '';

        $this->beConstructedWith($domain, $username, $password);
    }

    function it_successfully_connects_to_an_Exchange_server_with_user_credentials()
    {
        $this->connect()->shouldReturn(200);
    }
}
