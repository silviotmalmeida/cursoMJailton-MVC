<?php

namespace src\tests\feature\models;

require_once realpath(dirname(__FILE__) . '/../../../../config/configDB.php');

use PHPUnit\Framework\TestCase;
use src\helper\DateTimeHelper;
use src\models\TestModel;

class TestModelFeatureTest extends TestCase
{
    public function testQuery() {

        $model = new TestModel();
        $sql = "SELECT *  FROM test WHERE email = :email";
        $output = $model->query(
            $sql,
            ["email" => "email4@email.com"],
            false
        );

        
        print_r($output);
        die();

        $this->assertSame(DateTimeHelper::stringDateToArray($dateOption1, 1), ["16", "03", "2025"]);
        $this->assertSame(DateTimeHelper::stringDateToArray($dateOption2, 2), ["16", "03", "2025"]);
    }
}
