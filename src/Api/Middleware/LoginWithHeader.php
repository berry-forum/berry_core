<?php namespace Flarum\Api\Middleware;

use Flarum\Api\AccessToken;
use Illuminate\Contracts\Container\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Zend\Stratigility\MiddlewareInterface;

class LoginWithHeader implements MiddlewareInterface
{
    /**
     * @var Container
     */
    protected $app;

    /**
     * @var string
     */
    protected $prefix = 'Token ';

    /**
     * @param Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        $header = $request->getHeaderLine('authorization');
        if (starts_with($header, $this->prefix) &&
            ($token = substr($header, strlen($this->prefix))) &&
            ($accessToken = AccessToken::where('id', $token)->first())
        ) {
            $this->app->instance('flarum.actor', $user = $accessToken->user);

            $user->updateLastSeen()->save();
        }

        return $out ? $out($request, $response) : $response;
    }
}
