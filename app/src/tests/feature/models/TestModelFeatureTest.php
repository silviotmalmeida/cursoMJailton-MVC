<?php

namespace src\tests\feature\models;

use PDO;
use PHPUnit\Framework\TestCase;
use src\core\Database;
use src\helper\DateTimeHelper;
use src\models\TestModel;

class TestModelFeatureTest extends TestCase
{
    public function testQuery() {


        $models = TestModel::get([
            "email" => "email1@email.com"
        ]);
        
        print_r($models);
        die();

        $this->assertSame(DateTimeHelper::stringDateToArray($dateOption1, 1), ["16", "03", "2025"]);
        $this->assertSame(DateTimeHelper::stringDateToArray($dateOption2, 2), ["16", "03", "2025"]);
    }
}
