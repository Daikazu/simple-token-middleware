<?php

namespace Daikazu\SimpleTokenMiddleware\Tests;

use Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Orchestra\Testbench\TestCase;
use Daikazu\SimpleTokenMiddleware\ServiceProvider;
use Daikazu\SimpleTokenMiddleware\Facades\SimpleTokenMiddleware;
use Daikazu\SimpleTokenMiddleware\Http\Middleware\VerifySimpleToken;

class SimpleTokenMiddlewareTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'simple-token-middleware' => SimpleTokenMiddleware::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('simple-token-middleware.token', 'my_secret_token');
    }

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('simple.token')->any('/_test/webhook', function () {
            return 'OK';
        });
    }

    /** @test */
    public function testMiddleware()
    {
        $token = config('simple-token-middleware.token');

        $this->assertEquals($token, 'my_secret_token');
        $request = new Request();
        $request->merge([
            'token' => $token,
        ]);
        $middleware = new VerifySimpleToken();
        $middleware->handle($request, function ($req) use ($token) {
            $this->assertEquals($token, $req->token);
            $this->assertNotEquals('NOT_MY_TOKEN', $req->token);
        });
    }

    /** @test */
    public function isForbiddenWhenNoTokenIsProvided()
    {
        $response = $this->post('/_test/webhook', [
            'timestamp' => abs(time() - 100),
        ]);

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    /** @test */
    public function isForbiddenWhenInvalidTokenIsProvided()
    {
        $response = $this->post('/_test/webhook', [
            'timestamp' => abs(time() - 100),
            'token'     => 'invalid_token',
        ]);

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
    }

    /** @test */
    public function isOkWhenValidTokenIsProvided()
    {
        $response = $this->post('/_test/webhook', [
            'timestamp' => abs(time() - 100),
            'token'     => config('simple-token-middleware.token'),
        ]);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}
