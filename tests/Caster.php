<?php
namespace InspireBBS;
use InspireBBS\Model\ModelInterface;
use Symfony\Component\VarDumper\Caster\Caster;
use Symfony\Component\VarDumper\Cloner\Stub;

final class Caster
{
    /**
     * @param ModelInterface $c
     * @param array $a
     * @param Stub  $stub
     * @param bool  $isNested
     */
    public static function castModel(ModelInterface $c, array $a, Stub $stub, $isNested)
    {
        $ref = new \ReflectionClass($c);

        $ref_types = $ref->getProperty('property_types');
        $ref_types->setAccessible(true);
        $types = $ref_types->getValue();
        $ref_types->setAccessible(false);
        $a[Caster::PREFIX_PROTECTED.'property_types'] = $types;

        $ref_properties = $ref->getProperty('properties');
        $ref_properties->setAccessible(true);
        $properties = $ref_properties->getValue($c);
        $ref_properties->setAccessible(false);

        foreach ($properties as $key => $property) {
            $a[Caster::PREFIX_DYNAMIC.$key] = $property;
        }

        return $a;
    }
}
