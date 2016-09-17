<?php

namespace InspireBBS;

final class TripTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderFor_trip
     */
    public function test_trip($expected, $input)
    {
        $this->assertEquals($expected, trip($input));
    }

    public function dataProviderFor_trip()
    {
        return [
            ['ggrks/po1g', 'Mﾘ5tMC7u'],
            ['yGAhoNiShI', 'ｋａｍｉ'],
            ['Ig9vRBfuyA', 'Wikipedia'],
        ];
    }

    /**
     * @dataProvider dataProviderFor_tripize
     */
    public function test_tripize($expected, $input)
    {
        $this->assertEquals($expected, tripize($input));
    }

    public function dataProviderFor_tripize()
    {
        return [
            ['ただきちさん', 'ただきちさん'],
            ['ただきち◇さん', 'ただきち◆さん'],
            ['ひろゆき ◆yGAhoNiShI', 'ひろゆき#ｋａｍｉ'],
            ['うぃきぺたん ◆Ig9vRBfuyA', 'うぃきぺたん#Wikipedia'],
        ];
    }
}
