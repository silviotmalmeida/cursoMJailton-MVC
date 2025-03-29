<?php

namespace src\tests\feature\models;

use PHPUnit\Framework\TestCase;
use src\models\TestModel;

class TestModelFeatureTest extends TestCase
{
    public function testGet()
    {
        $expectedArray = array(
            new TestModel(
                [
                    "id" => "1",
                    "name" => "Nome 1",
                    "email" => "email1@email.com",
                    "profession" => "engenheiro",
                ]
            ),
            new TestModel(
                [
                    "id" => "2",
                    "name" => "Nome 2",
                    "email" => "email2@email.com",
                    "profession" => "médico",
                ]
            ),
            new TestModel(
                [
                    "id" => "3",
                    "name" => "Nome 3",
                    "email" => "email3@email.com",
                    "profession" => "engenheiro",
                ]
            )
        );

        $models = TestModel::get();

        $this->assertEquals($expectedArray, $models);
    }

    public function testGetColumns()
    {
        $expectedArray = array(
            new TestModel(
                [
                    "name" => "Nome 1",
                    "email" => "email1@email.com"
                ]
            ),
            new TestModel(
                [
                    "name" => "Nome 2",
                    "email" => "email2@email.com"
                ]
            ),
            new TestModel(
                [
                    "name" => "Nome 3",
                    "email" => "email3@email.com"
                ]
            )
        );

        $models = TestModel::get(
            columns: 'name,email'
        );

        $this->assertEquals($expectedArray, $models);
    }

    public function testGetFilterAnd()
    {
        $expectedArray = array(
            new TestModel(
                [
                    "id" => "3",
                    "name" => "Nome 3",
                    "email" => "email3@email.com",
                    "profession" => "engenheiro",
                ]
            )
        );

        $models = TestModel::get(
            filters: [
                'profession' => 'engenheiro',
                'id' => 3
            ],
            filterType: 'AND'
        );

        $this->assertEquals($expectedArray, $models);
    }

    public function testGetFilterOr()
    {
        $expectedArray = array(
            new TestModel(
                [
                    "id" => "1",
                    "name" => "Nome 1",
                    "email" => "email1@email.com",
                    "profession" => "engenheiro",
                ]
            ),
            new TestModel(
                [
                    "id" => "2",
                    "name" => "Nome 2",
                    "email" => "email2@email.com",
                    "profession" => "médico",
                ]
            ),
            new TestModel(
                [
                    "id" => "3",
                    "name" => "Nome 3",
                    "email" => "email3@email.com",
                    "profession" => "engenheiro",
                ]
            )
        );

        $models = TestModel::get(
            filters: [
                'profession' => 'engenheiro',
                'id' => 2
            ],
            filterType: 'OR'
        );

        $this->assertEquals($expectedArray, $models);
    }

    public function testGetOrderAsc()
    {
        $expectedArray = array(
            new TestModel(
                [
                    "id" => "1",
                    "name" => "Nome 1",
                    "email" => "email1@email.com",
                    "profession" => "engenheiro",
                ]
            ),
            new TestModel(
                [
                    "id" => "2",
                    "name" => "Nome 2",
                    "email" => "email2@email.com",
                    "profession" => "médico",
                ]
            ),
            new TestModel(
                [
                    "id" => "3",
                    "name" => "Nome 3",
                    "email" => "email3@email.com",
                    "profession" => "engenheiro",
                ]
            )
        );

        $models = TestModel::get(orderColumn: 'id', orderType: 'ASC');

        $this->assertEquals($expectedArray, $models);
    }

    public function testGetOrderDesc()
    {
        $expectedArray = array(
            new TestModel(
                [
                    "id" => "3",
                    "name" => "Nome 3",
                    "email" => "email3@email.com",
                    "profession" => "engenheiro",
                ]
            ),
            new TestModel(
                [
                    "id" => "2",
                    "name" => "Nome 2",
                    "email" => "email2@email.com",
                    "profession" => "médico",
                ]
            ),
            new TestModel(
                [
                    "id" => "1",
                    "name" => "Nome 1",
                    "email" => "email1@email.com",
                    "profession" => "engenheiro",
                ]
            )
        );

        $models = TestModel::get(orderColumn: 'id', orderType: 'DESC');

        $this->assertEquals($expectedArray, $models);
    }
}
