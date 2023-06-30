<?php
/**
 * Created by PhpStorm.
 * User: hugh.li
 * Date: 2021/4/20
 * Time: 4:21 下午.
 */

namespace HughCube\Laravel\AliYunMarket;

use Closure;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use HughCube\GuzzleHttp\Client as HttpClient;
use HughCube\GuzzleHttp\HttpClientTrait;
use Illuminate\Support\Collection;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    use HttpClientTrait;

    /**
     * @var Collection
     */
    protected $config;

    /**
     * @param Collection|array $config
     */
    public function __construct($config)
    {
        $this->config = Collection::make($config);
    }

    public function getConfig(): Collection
    {
        return $this->config;
    }

    /**
     * @return HttpClient
     */
    protected function createHttpClient(): HttpClient
    {
        $config = $this->getConfig()->get('Http', []);

        $config['handler'] = $handler = HandlerStack::create();
        $handler->push($this->httpAuthHandler());

        return new HttpClient($config);
    }

    /**
     * 添加请求头信息.
     *
     * @return Closure
     */
    private function httpAuthHandler(): Closure
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {

                if (!$request->hasHeader('Authorization')) {
                    $appcode = $this->getConfig()->get('AppCode');
                    $request = $request->withHeader('Authorization', sprintf('APPCODE %s', $appcode));
                }

                return $handler($request, $options);
            };
        };
    }

    /**
     * @throws GuzzleException
     */
    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        return $this->getHttpClient()->request($method, $uri, $options);
    }
}
