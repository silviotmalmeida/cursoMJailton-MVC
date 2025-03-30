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

    /**
     * @depends testGet
     */
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

    /**
     * @depends testGetColumns
     */
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

    /**
     * @depends testGetFilterAnd
     */
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

    /**
     * @depends testGetFilterOr
     */
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

    /**
     * @depends testGetOrderAsc
     */
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

    /**
     * @depends testGetOrderDesc
     */
    public function testGetLimit1()
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
        );

        $models = TestModel::get(orderColumn: 'id', orderType: 'ASC', limit: 1);

        $this->assertEquals($expectedArray, $models);
    }

    /**
     * @depends testGetLimit1
     */
    public function testPreparedGet()
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

        $models = TestModel::preparedGet();

        $this->assertEquals($expectedArray, $models);
    }

    /**
     * @depends testPreparedGet
     */
    public function testPreparedGetColumns()
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

        $models = TestModel::preparedGet(
            columns: 'name,email'
        );

        $this->assertEquals($expectedArray, $models);
    }

    /**
     * @depends testPreparedGetColumns
     */
    public function testPreparedGetFilterAnd()
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

        $models = TestModel::preparedGet(
            filters: [
                'profession' => 'engenheiro',
                'id' => 3
            ],
            filterType: 'AND'
        );

        $this->assertEquals($expectedArray, $models);
    }

    /**
     * @depends testPreparedGetFilterAnd
     */
    public function testPreparedGetFilterOr()
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

        $models = TestModel::preparedGet(
            filters: [
                'profession' => 'engenheiro',
                'id' => 2
            ],
            filterType: 'OR'
        );

        $this->assertEquals($expectedArray, $models);
    }

    /**
     * @depends testPreparedGetFilterOr
     */
    public function testPreparedGetOrderAsc()
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

        $models = TestModel::preparedGet(orderColumn: 'id', orderType: 'ASC');

        $this->assertEquals($expectedArray, $models);
    }

    /**
     * @depends testPreparedGetOrderAsc
     */
    public function testPreparedGetOrderDesc()
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

        $models = TestModel::preparedGet(orderColumn: 'id', orderType: 'DESC');

        $this->assertEquals($expectedArray, $models);
    }

    /**
     * @depends testPreparedGetOrderDesc
     */
    public function testPreparedGetLimit1()
    {
        $expectedArray = array(
            new TestModel(
                [
                    "id" => "1",
                    "name" => "Nome 1",
                    "email" => "email1@email.com",
                    "profession" => "engenheiro",
                ]
            )
        );

        $models = TestModel::preparedGet(orderColumn: 'id', orderType: 'ASC', limit: 1);

        $this->assertEquals($expectedArray, $models);
    }

    /**
     * @depends testPreparedGetLimit1
     */
    public function testInsert()
    {
        $expectedName = "Nome Insert";
        $expectedEmail = "insert@email.com";
        $expectedProfession = "Profession Insert";

        $object = new TestModel(
            [
                "name" => $expectedName,
                "email" => $expectedEmail,
                "profession" => $expectedProfession,
            ]
        );
        $id = $object->insert();

        $models = TestModel::get(filters: ['id' => $id]);

        $expectedArray = array(
            new TestModel(
                [
                    "id" => $id,
                    "name" => $expectedName,
                    "email" => $expectedEmail,
                    "profession" => $expectedProfession,
                ]
            )
        );

        $this->assertEquals($expectedArray, $models);

        TestModel::deleteById($id);
    }

    /**
     * @depends testInsert
     */
    public function testDelete()
    {
        $expectedName = "Nome Insert";
        $expectedEmail = "insert@email.com";
        $expectedProfession = "Profession Insert";

        $object = new TestModel(
            [
                "name" => $expectedName,
                "email" => $expectedEmail,
                "profession" => $expectedProfession,
            ]
        );
        $id = $object->insert();

        $models = TestModel::get(filters: ['id' => $id]);

        $this->assertNotEquals([], $models);

        $models[0]->delete();

        $models = TestModel::get(filters: ['id' => $id]);

        $this->assertEquals([], $models);
    }

    /**
     * @depends testDelete
     */
    public function testUpdate()
    {
        $initialName = "Nome Insert";
        $initialEmail = "insert@email.com";
        $initialProfession = "Profession Insert";

        $object = new TestModel(
            [
                "name" => $initialName,
                "email" => $initialEmail,
                "profession" => $initialProfession,
            ]
        );
        $id = $object->insert();

        $expectedName = "Nome Update";
        $expectedEmail = "update@email.com";
        $expectedProfession = "Profession Update";

        $models = TestModel::get(filters: ['id' => $id]);

        $models[0]->name = $expectedName;
        $models[0]->email = $expectedEmail;
        $models[0]->profession = $expectedProfession;

        $models[0]->update();

        $models = TestModel::get(filters: ['id' => $id]);

        $expectedArray = array(
            new TestModel(
                [
                    "id" => $id,
                    "name" => $expectedName,
                    "email" => $expectedEmail,
                    "profession" => $expectedProfession,
                ]
            )
        );

        $this->assertEquals($expectedArray, $models);

        TestModel::deleteById($id);
    }
}
