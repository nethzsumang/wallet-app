<?php
namespace App\Models\Traits;

use ReflectionClass;
use ReflectionMethod;
use Illuminate\Database\Eloquent\Relations\Relation;

trait GetRelationships
{
    /**
     * Available relationships for the model.
     *
     * @var array
     */
    protected static $availableRelations = [];

    /**
     * Gets list of available relations for this model
     * And stores it in the variable for future use
     *
     * @return array
     */
    public static function getAvailableRelations()
    {
        return static::$availableRelations[static::class] ?? static::setAvailableRelations(
            array_reduce(
                (new ReflectionClass(static::class))->getMethods(ReflectionMethod::IS_PUBLIC),
                function ($result, ReflectionMethod $method) {
                    // If this function has a return type
                    ($returnType = (string) $method->getReturnType()) &&

                    // And this function returns a relation
                    is_subclass_of($returnType, Relation::class) &&

                    // Add name of this method to the relations array
                    ($result = array_merge($result, [$method->getName() => $returnType]));

                    return $result;
                }, []
            )
        );
    }

    /**
     * Stores relationships for future use
     *
     * @param array $relations
     * @return array
     */
    public static function setAvailableRelations(array $relations)
    {
        static::$availableRelations[static::class] = $relations;

        return $relations;
    }
}