<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 11:45 下午.
 */

namespace HughCube\Laravel\AliYunMarket\Tests;

use HughCube\Laravel\AliYunMarket\Client;
use HughCube\Laravel\AliYunMarket\Manager;
use HughCube\Laravel\AliYunMarket\AliYunMarket;

class FacadeTest extends TestCase
{
    public function testIsFacade()
    {
        $this->assertInstanceOf(Manager::class, AliYunMarket::getFacadeRoot());
    }

    public function testDriver()
    {
        $this->assertInstanceOf(Client::class, AliYunMarket::client());
    }
}
