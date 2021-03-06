# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

Versions 0.3.0 and prior were released as "weierophinney/problem-details".

## 1.1.1 - TBD

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.1.0 - 2019-12-30

### Added

- [zendframework/zend-problem-details#51](https://github.com/zendframework/zend-problem-details/pull/51) adds a new `problem-details.default_types_map` config option, which can be used to define custom `type` values based on status codes.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.0.2 - 2019-01-09

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zendframework/zend-problem-details#46](https://github.com/zendframework/zend-problem-details/pull/46) adds code to ensure newlines are stripped when creating key names for XML
  payloads.

## 1.0.1 - 2018-07-25

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zendframework/zend-problem-details#39](https://github.com/zendframework/zend-problem-details/pull/39) adds the `public` visibility modifier to all constants.

- [zendframework/zend-problem-details#41](https://github.com/zendframework/zend-problem-details/pull/41) prevents crashes when the `ProblemDetailsResponseFactory` attempts to
  encode malformed UTF-8 sequences to JSON by ensuring the
  `JSON_PARTIAL_OUTPUT_ON_ERROR` flag is enabled.

## 1.0.0 - 2018-03-15

### Added

- [zendframework/zend-problem-details#30](https://github.com/zendframework/zend-problem-details/pull/30)
  adds PSR-15 support.

### Changed

- [zendframework/zend-problem-details#24](https://github.com/zendframework/zend-problem-details/pull/24)
  updates all classes to use scalar and return type hints, including nullable
  and void types. If you were extending classes within an earlier release, you
  may need to update signatures of any methods you override.

- [zendframework/zend-problem-details#35](https://github.com/zendframework/zend-problem-details/pull/35)
  modifies the constructor of `Mezzio\ProblemDetails\ProblemDetailsResponseFactory`
  such that it now has the following signature:

  ```php
  public function __construct(
      callable $responseFactory,
      bool $isDebug = self::EXCLUDE_THROWABLE_DETAILS,
      int $jsonFlags = null,
      bool $exceptionDetailsInResponse = false,
      string $defaultDetailMessage = self::DEFAULT_DETAIL_MESSAGE
  )
  ```

  Note that the first argument is now a `$responseFactory`, is required, and
  must be `callable`. The previous `$responsePrototype` and `$streamFactory`
  arguments are now removed.

  The `$responseFactory` will be invoked with no arguments, and MUST return a
  PSR-7 ResponseInterface instance.

- [zendframework/zend-problem-details#35](https://github.com/zendframework/zend-problem-details/pull/35) modifies
  internals of `Mezzio\ProblemDetails\ProblemDetailsResponseFactoryFactory` as
  follows:

  - It no longer looks for a `Mezzio\ProblemDetails\StreamFactory` service.
  - It now _requires_ the `Psr\Http\Message\ResponseInterface` service, and
    expects it to resolve to a PHP callable capable of producing such an instance
    (instead of a response instance directly).

- [zendframework/zend-problem-details#35](https://github.com/zendframework/zend-problem-details/pull/35)
  modifies the constructor of `Mezzio\ProblemDetails\ProblemDetailsMiddleware`;
  the `$responseFactory` argument is now required.

- [zendframework/zend-problem-details#35](https://github.com/zendframework/zend-problem-details/pull/35)
  modifies the constructor of `Mezzio\ProblemDetails\ProblemDetailsNotFoundHandler`;
  the `$responseFactory` argument is now required.

- [zendframework/zend-problem-details#34](https://github.com/zendframework/zend-problem-details/pull/34) updates
  the behavior when passing null as the `$jsonFlag` parameter to the
  `Mezzio\ProblemDetails\ProblemDetailsResponseFactory` constructor; in such
  situations, the default `json_encode()` flags will include `JSON_PRETTY_PRINT`
  only when the `$isDebug` argument is boolean `true`.

### Deprecated

- Nothing.

### Removed

- [zendframework/zend-problem-details#22](https://github.com/zendframework/zend-problem-details/pull/22) and
  [zendframework/zend-problem-details#30](https://github.com/zendframework/zend-problem-details/pull/30)
  remove support for both `http-interop/http-middleware` and
  `http-interop/http-server-middleware`.

- [zendframework/zend-problem-details#22](https://github.com/zendframework/zend-problem-details/pull/22)
  removes `MissingResponseException` as it cannot be thrown anymore,
  because interfaces have PHP7 return type and `TypeError` will be thrown.

### Fixed

- Nothing.

## 0.5.3 - 2018-03-12

### Added

- Nothing.

### Changed

- [zendframework/zend-problem-details#32](https://github.com/zendframework/zend-problem-details/pull/32) updates
  the `ProblemDetailsResponseFactoryFactory` to allow the `ResponseInterface`
  service to either return an instance, or a factory capable of generating an
  instance.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.5.2 - 2018-01-10

### Added

- [zendframework/zend-problem-details#29](https://github.com/zendframework/zend-problem-details/pull/29) adds
  the ability for the `ProblemDetailsMiddleware` to trigger listeners when
  it catches a `Throwable` to produce a response. Listeners are PHP callables
  and receive the following arguments, in the following order:

  - `Throwable $error`: the throwable/exception caught by the
    `ProblemDetailsMiddleware`.
  - `ServerRequestInterface $request`: the request handled by the
    `ProblemDetailsMiddleware`.
  - `ResponseInterface $response`: the response generated by the
    `ProblemDetailsMiddleware`.

  Attach listeners using the `ProblemDetailsMiddleware::attachListeners()`
  instance method.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.5.1 - 2017-12-07

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zendframework/zend-problem-details#20](https://github.com/zendframework/zend-problem-details/pull/20) fixes an
  issue with serialization when PHP resources are within the `$additional`
  aspect of the payload. When these values are encountered, the response factory
  now will instead return `Resource of type {resource type}`.

- [zendframework/zend-problem-details#21](https://github.com/zendframework/zend-problem-details/pull/21) provides
  a defence for `$additional` data keys that would otherwise create malformed
  XML tag names.

## 0.5.0 - 2017-10-09

### Added

- In [zendframework/zend-problem-details#1](https://github.com/zendframework/zend-problem-details/pull/1),
  `Mezzio\ProblemDetails\ProblemDetailsResponseFactory` was updated to attempt to
  generate a secure-by-default and secure-in-production Problem Details response
  when the response is generated from an exception; essentially, it now defaults
  to NOT exposing this information, in order to prevent exposing internals of
  the application in production.

  To provide this, it adds two new, optional, constructor arguments:

  - `bool $exceptionDetailsInResponse` is a flag detailing whether or not
    details from an exception (except `ProblemDetailsException` custom data)
    should be used in the Problem Details response; by default this is `false`
  - `string $defaultDetailMessage` is a default message to use for the `detail`
    key of the response in such situations; the default value is `An unknown
    error occurred.`.

  Additionally, `ProblemDetailsResponseFactoryFactory` was updated to re-use the
  configuration `debug` setting for the `$exceptionDetailsInResponse` flag.

- [zendframework/zend-problem-details#7](https://github.com/zendframework/zend-problem-details/pull/7) adds a
  `ProblemDetailsNotFoundHandler` class and associated factory. This can be used
  in place of the default application `NotFoundHandler`, in addition to it, or
  within specific routed pipelines in order to provide Problem Details 404
  responses.

- [zendframework/zend-problem-details#8](https://github.com/zendframework/zend-problem-details/pull/8) adds
  `Mezzio\ProblemDetails\Exception\ExceptionInterface`, a marker
  interface for exceptions provided by the package.

- [zendframework/zend-problem-details#12](https://github.com/zendframework/zend-problem-details/pull/12) adds
  support for http-interop/http-middleware 0.5.0 via a polyfill provided by the
  package webimpress/http-middleware-compatibility. Essentially, this means you
  can drop this package into an application targeting either the 0.4.1 or 0.5.0
  versions of http-middleware, and it will "just work".

### Changed

- [zendframework/zend-problem-details#8](https://github.com/zendframework/zend-problem-details/pull/8) renames the
  interface `ProblemDetailsException` to `ProblemDetailsExceptionInterface`.
  This was done to make the naming consistent with other Laminas packages.

- [zendframework/zend-problem-details#8](https://github.com/zendframework/zend-problem-details/pull/8) renames the
  trait `CommonProblemDetailsException` to `CommonProblemDetailsExceptionTrait`.
  This was done to make the naming consistent with other Laminas packages.

- [zendframework/zend-problem-details#8](https://github.com/zendframework/zend-problem-details/pull/8) updates the
  shipped `InvalidResponseBodyException` and `MissingResponseException` to
  extend the new `ExceptionInterface`.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.4.0 - 2017-08-01

### Added

- Nothing.

### Changed

- The package is now named "zendframework/zend-problem-details".
- The top-level namespace is now named `Zend\ProblemDetails`.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.3.0 - 2017-07-31

### Added

- [zendframework/zend-problem-details#7](https://github.com/weierophinney/problem-details/pull/7) adds an explicit
  dependency on ext/json.

### Changed

- [zendframework/zend-problem-details#7](https://github.com/weierophinney/problem-details/pull/7) updates each
  of the following to place them under the new `ProblemDetails\Exception`
  namespace:
  - `CommonProblemDetailsException`
  - `InvalidResponseBodyException`
  - `MissingResponseException`
  - `ProblemDetailsException`

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 0.2.1 - 2017-06-13

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zendframework/zend-problem-details#5](https://github.com/weierophinney/problem-details/pull/5) updates the
  response factory and middleware to treat lack of/empty `Accept` header values
  as `*/*`, per RFC-7231 section 5.3.2.

## 0.2.0 - 2017-05-30

### Added

- [zendframework/zend-problem-details#4](https://github.com/weierophinney/problem-details/pull/4) adds
  `ProblemDetailsReponseFactoryFactory` for generating a
  `ProblemDetailsResponseFactory` instance.

### Changed

- [zendframework/zend-problem-details#4](https://github.com/weierophinney/problem-details/pull/4) changes the
  `ProblemDetailsResponseFactory` in several ways:
  - It is now instantiable. The constructor accepts a boolean indicating debug
    status (`false` by default), an integer bitmask of JSON encoding flags, a
    PSR-7 `ResponseInterface` instance, and a callable factory for generating a
    writable PSR-7 `StreamInterface` for the final problem details response
    content.
  - `createResponse()` is now an instance method, and its first argument is no
    longer an `Accept` header, but a PSR-7 `ServerRequestInterface` instance.
  - `createResponseFromThrowable()` is now an instance method, and its first
    argument is no longer an `Accept` header, but a PSR-7
    `ServerRequestInterface` instance.

- [zendframework/zend-problem-details#4](https://github.com/weierophinney/problem-details/pull/4) changes the
  `ProblemDetailsMiddleware`; it now composes a `ProblemDetailsResponseFactory`
  insteead of an `isDebug` flag. Additionally, it no longer wraps processing of
  the delegate in a try/catch block if the request cannot accept JSON or XML.

- [zendframework/zend-problem-details#4](https://github.com/weierophinney/problem-details/pull/4) changes the
  `ProblemDetailsMiddlewareFactory` to inject the `ProblemDetailsMiddleware`
  with a `ProblemDetailsResponseFactory` instead of an `isDebug` flag.

### Deprecated

- Nothing.

### Removed

- [zendframework/zend-problem-details#4](https://github.com/weierophinney/problem-details/pull/4) removes the
  `ProblemDetailsJsonResponse`; use the `ProblemDetailsResponseFactory` instead.

- [zendframework/zend-problem-details#4](https://github.com/weierophinney/problem-details/pull/4) removes the
  `ProblemDetailsXmlResponse`; use the `ProblemDetailsResponseFactory` instead.

- [zendframework/zend-problem-details#4](https://github.com/weierophinney/problem-details/pull/4) removes the
  `CommonProblemDetails` trait; the logic is now incorporated in the
  `ProblemDetailsResponseFactory`.

- [zendframework/zend-problem-details#4](https://github.com/weierophinney/problem-details/pull/4) removes the
  `ProblemDetailsResponse` interface; PSR-7 response prototypes are now used
  instead.

### Fixed

- [zendframework/zend-problem-details#4](https://github.com/weierophinney/problem-details/pull/4) updates JSON
  response generation to allow specifying your own JSON encoding flags. By
  default, it now does pretty JSON, with unescaped slashes and unicode.

## 0.1.0 - 2017-05-03

Initial Release.

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
