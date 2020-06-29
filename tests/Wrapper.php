<?php 

    namespace Tests;

    use App\App;
    use App\DotEnv;
    use App\Utils\Service;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;
    use Slim\Http\Request;
    use Slim\Http\Response;

    class Wrapper extends \PHPUnit\Framework\TestCase{

        protected static $container;
        protected static $store = [];

        public function beforeTest() {
            putenv("_UNIT_TEST=1");
            DotEnv::load();
            Service::$path = "./Services";
        }

        protected function getRequest(string $method, string $uri, string $queryString = ""): Request{
            $env = \Slim\Http\Environment::mock([
                'REQUEST_METHOD' => $method,
                'REQUEST_URI' => $uri,
                'QUERY_STRING' => $queryString
            ]);

            return Request::createFromEnvironment($env);
        }

        protected function generate(ServerRequestInterface $request): ResponseInterface{
            $app = new App();
            // replacing container by the container app
            self::$container = $app->getContainer();
            return $app->callMiddlewareStack($request, new Response());
        }

        public function parseJsonResponse(ResponseInterface $response): array{
            return json_decode($response->getBody()->__toString(), true);
        }

    }