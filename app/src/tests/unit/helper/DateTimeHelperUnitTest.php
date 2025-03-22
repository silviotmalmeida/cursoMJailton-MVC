<?php

namespace src\tests\unit\helper;

use PHPUnit\Framework\TestCase;
use src\helper\DateTimeHelper;

class DateTimeHelperUnitTest extends TestCase
{
    public function testStringDateToArrayTest() {

        $dateOption1 = "2025-03-16";
        $dateOption2 = "16-03-2025";

        $this->assertSame(DateTimeHelper::stringDateToArray($dateOption1, 1), ["16", "03", "2025"]);
        $this->assertSame(DateTimeHelper::stringDateToArray($dateOption2, 2), ["16", "03", "2025"]);
    }
}
