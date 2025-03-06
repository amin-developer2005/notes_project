<?php
/**
 * Created by IntelliJ IDEA.
 * User: mohammadAmin
 * email: mohamadamin.meghdadi@gmail.com
 * Date: 3/8/2024
 * Time: 8:20 PM
 */


namespace Core;

use Symfony\Component\DependencyInjection\Exception\BadMethodCallException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

use Symfony\Component\HttpFoundation\Response;



class Url
{

    private static SymfonyRequest $request;
    private static InputBag $json;

    private const ALLOWED_PROTOCOLS = ['http', 'https'];


    public function __construct()
    {
        self::initializeRequest();
    }


    private static function initializeRequest(): void
    {
        self::$request = SymfonyRequest::createFromGlobals();
    }



    public static function baseUrl(): ?string
    {
        // TODO: Implement baseUrl() method.
        self::initializeRequest();

        $appScheme = self::$request->getScheme();
        $appHost = self::$request->getHttpHost();
        $basePath = empty(self::$request->getBasePath()) ? '/' : self::$request->getBasePath();

        if (! in_array($appScheme, self::ALLOWED_PROTOCOLS)) {
            return null;
        }

        return rtrim($appScheme . '://' . $appHost . $basePath);
    }



    public static function getUrl(): ?string
    {
        self::initializeRequest();

        $url = self::$request->getUri();
        $appScheme = self::$request->getScheme();

        if (!in_array($appScheme, self::ALLOWED_PROTOCOLS, true)) {
            return null;
        }

        $cleaUrl = preg_replace('/\?.*/', '', $url);
        return rtrim($cleaUrl, '/');
    }



    /**
     * @param $uri
     * This method returns the baseUrl of the website along with the provided URL;
     * @return string
     */
    public static function load($uri): string
    {
        // TODO: Implement load() method.
        $baseUrl = self::baseUrl();
        return $baseUrl . $_ENV['APP_NAME'] . $uri;
    }



    /**
     * Retrieves the request current URL path.
     * @return string The current URL.
     */
    public static function getRequestUrl(): string
    {
        // TODO: Implement getRequestUrl() method.
        self::initializeRequest();

        $path = self::$request->getPathInfo();
        $path = str_replace($_ENV['APP_NAME'] . "/", '', $path);

        return null != $path ? rawurldecode($path) : '/';
    }



    public static function getFullUrl(): ?string
    {
        // TODO: Implement getFullUrl() method.
        $baseUrl = self::baseUrl();

        if (null !== $query = self::$request->getQueryString()) {
            $query = '?' . $query;
        }

        return !is_null($query) ? $baseUrl . self::getRequestUrl() . $query : self::getUrl();
    }



    public static function fetchRequestMethod()
    {
        return self::$request->getRealMethod();
    }


    public static function isRequestMethod($method): bool
    {
        return self::$request->isMethod($method);
    }



    public static function fetchQuery($field = null, $default = null): float|int|bool|array|string|null
    {
        if (!self::$request->isMethod('GET')) {
            throw new BadRequestException('The request method is not GET!');
        }

        if (!is_null($field)) {
            return self::$request->query->get($field, $default);
        }

        return self::$request->query->all();
    }



    public static function hasQuery(string $field): bool
    {
        return self::$request->query->has($field);
    }





    public static function fetchPost($field = null, $default = null) {
        if (!self::$request->isMethod('POST')) {
            throw new BadRequestException('The request method is not POST!');
        }


        if (!is_null($field)) {
            return self::$request->request->get($field, $default);
        }

        return self::$request->request->all();
    }


    public static function hasPost($field): bool
    {
        return self::$request->request->has($field);
    }



    public static function fetchHeader($field = null, $default = null) {
        if (!self::$request->isMethod('SERVER')) {
            throw new BadRequestException('The request method is not HEADER!');
        }

        if (!is_null($field)) {
            return self::$request->headers->get($field, $default);
        }

        return self::$request->headers->all();
    }



    public static function fetchServer($field = null, $default = null) {
        if (!self::$request->isMethod('SERVER')) {
            throw new BadRequestException('The request method is not SERVER!');
        }

        if (!is_null($field)) {
            return self::$request->server->get($field, $default);
        }

        return self::$request->server->all();
    }



    public static function fetchFile($field = null, $default = null)
    {
        if (!self::$request->isMethod('FILE')) {
            throw new BadMethodCallException("The request method is not FILE!");
        }

        if (!is_null($field)) {
            return self::$request->files->get($field, $default);
        }

        return self::$request->files->all();
    }


    public static function fetchCookie($field = null, $default = null): float|int|bool|array|string|null
    {
        if (!self::$request->isMethod('COOKIE')) {
            throw new BadRequestException('The request method is not COOKIE!');
        }

        if (!is_null($field)) {
            return self::$request->cookies->get($field, $default);
        }

        return self::$request->cookies->all();
    }


    public static function fetchAttribute($field = null, $default = null): ?array
    {
        if (!self::$request->isMethod('ATTRIBUTE')) {
            throw new BadRequestException('The request method is not ATTRIBUTE!');
        }

        if (!is_null($field)) {
            return self::$request->attributes->get($field, $default);
        }

        return self::$request->attributes->all();
    }







    protected static function fetchInputSource(): InputBag|SymfonyRequest|null
    {
        if (self::isJson()) {
            return self::json();
        }

        return in_array(self::$request->getRealMethod(), ['HEAD, POST']) ? self::$request->request : self::$request->query;
    }



    public static function mergeInputs(array $inputs): void
    {
        self::fetchInputSource()->add($inputs);
    }

    public static function replaceInputs(array $inputs): void
    {
        self::fetchInputSource()->replace($inputs);
    }



    public static function fetchIP(): ?string
    {
        return self::$request->getClientIp();
    }






    public static function isAJAX():bool
    {
        return self::$request->isXmlHttpRequest();
    }


    public static function isPJAX(): bool
    {
        return true === self::$request->headers->get('X-PJAX');
    }


    public static function isJson(): bool
    {
        return str_contains(self::$request->headers->get('CONTENT_TYPE'), 'json');
    }


    public static function json()
    {
        if (isset(self::$json) && !is_null(self::$json)) {
            return self::$json;
        }


        if (null != $content = self::$request->getContent()) {

            try {
                $decodedContent = json_decode($content, true);
                self::$json = new InputBag($decodedContent);
            } catch (JsonException $jsonException) {
                throw new JsonException("Failed to decode the contents {$content} to JSON", $jsonException->getCode(), $jsonException->getPrevious());
            }

        } else {
            self::$json = new InputBag([]);
        }

        return self::$json;
    }





    public static function fetch($field) {
        return self::fetchInputSource()->get($field);
    }


    public function __set(string $field, $val): void
    {
        // TODO: Implement __set() method.
        self::fetchInputSource()->set($field, $val);
    }


    public function __get(string $field)
    {
        // TODO: Implement __get() method.
        if (self::fetchInputSource()->has($field)) {
            return self::fetch($field);
        }
        return null;
    }


    public function __isset(string $field): bool
    {
        // TODO: Implement __isset() method.
        return !is_null(self::__get($field));
    }



    public static function sendResponse() {
        $response = new Response();
        $response->setContent("Welcome to our website");
        $response->setStatusCode(Response::HTTP_OK);

        $response->headers->set('Content-Type', 'text/plain');
    }
}