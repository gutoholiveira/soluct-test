<?php

namespace App\Traits;

trait IsEnum
{
    /**
     * Returns value of $key
     * @param string $key
     * @return mixed
     */
    public static function valueOf(string $key): mixed
    {
        foreach (static::cases() as $enum)
        {
            if ($enum->name === strtoupper($key))
            {
                return $enum->value;
            }
        }

        return null;
    }

    /**
     * Returns case of string $key
     * @param string $key
     * @return static|null
     */
    public static function caseOf(string $key): ?static
    {
        foreach (static::cases() as $enum)
        {
            if ($enum->name === strtoupper($key))
            {
                return $enum;
            }
        }

        return null;
    }

    /**
     * Returns array of enum names.
     *
     * @return array
     */
    public static function names(): array
    {
        return array_column(static::cases(), 'name');
    }

    /**
     * Returns array of enum values.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(static::cases(), 'value');
    }

    /**
     * Returns enum into array $key => $value.
     *
     * @return array
     */
    public static function toArray(): array
    {
        return array_combine(static::names(), self::values());
    }

    /**
     * Returns if param $compare is equals to enum value.
     *
     * @param bool|string|int|self $compare
     * @return bool
     */
    public function equals(bool|string|int|self $compare): bool
    {
        $value = is_int($compare) || is_string($compare) || is_bool($compare)
            ? $compare
            : $compare->value;

        return $this->value == $value;
    }

    /**
     * Returns if ENUM value is equals to one of the options.
     *
     * @param array $compare
     * @return bool
     */
    public function has(array $compare): bool
    {
        foreach ($compare as $comp)
        {
            $equals = $this->equals($comp);

            if ($equals)
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Similar to "get," this name implies that the method retrieves something specific (in this case, an enum value).
     *
     * @param mixed $key
     * @return mixed
     */
    public static function retrieve(mixed $key): mixed
    {
        if(is_a($key, self::class))
        {
            $key = $key->value;
        }

        return $key;
    }

    /**
     * Get all values from a specific method
     *
     * @param string $target
     * @param mixed ...$args
     * @return array
     */
    public static function all(string $target = 'slug', ...$args): array
    {
        $values = [];

        foreach (self::cases() as $case)
        {
            $method   = $target;
            $values[] = call_user_func([$case, $method], ...$args);
        }

        return $values;
    }
}
