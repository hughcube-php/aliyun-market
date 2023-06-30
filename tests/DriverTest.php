<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 11:36 下午.
 */

namespace HughCube\Laravel\AliYunMarket\Tests;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use HughCube\Laravel\AliYunMarket\AliYunMarket;
use Psr\Http\Message\ResponseInterface;

class DriverTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function testStore()
    {
        $response = AliYunMarket::client()->request(
            'GET',
            'https://www.baidu.com/',
            [
                RequestOptions::DEBUG => true
            ]
        );

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }
}
