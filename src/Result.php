<?php

namespace Larsmbergvall\UtilitiesForLaravel;

/**
 * @template T
 * @template E
 */
class Result
{
    /** @return E|null */
    public function getErr()
    {
        return $this->error;
    }

    /** @return T|null */
    public function getValue()
    {
        return $this->value;
    }

    private bool $isOk;

    /** @var T|null */
    private mixed $value;

    /** @var E|null */
    private mixed $error;

    /**
     * @param  T|null  $value
     * @param  E|null  $error
     */
    private function __construct(bool $isOk, $value, $error)
    {
        $this->isOk = $isOk;
        $this->value = $value;
        $this->error = $error;
    }

    /**
     * Create a Result representing a successful operation.
     *
     * @template TNewOk
     *
     * @param  TNewOk  $value
     * @return Result<TNewOk, E>
     *
     * @phpstan-return Result<TNewOk, null>
     */
    public static function ok($value): Result
    {
        return new self(true, $value, null);
    }

    /**
     * @template TNewErr
     *
     * @param  TNewErr  $error
     * @return Result<T, TNewErr>
     *
     * @phpstan-return Result<null, TNewErr>
     */
    public static function err($error): Result
    {
        return new self(false, null, $error);
    }

    public function isOk(): bool
    {
        return $this->isOk;
    }

    public function isErr(): bool
    {
        return ! $this->isOk;
    }

    /**
     * @param  callable(T|null): mixed  $ok
     * @param  callable(E|null): mixed  $err
     */
    public function match(callable $ok, callable $err): mixed
    {
        if ($this->isOk) {
            return $ok($this->value);
        } else {
            return $err($this->error);
        }
    }
}
