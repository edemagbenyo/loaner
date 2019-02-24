<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\AccountReport;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReportTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccountReporthasADate()
    {

        $res =  $this->get('/');
         $res->assertStatus(404);
        //Given
        //When
        //Then
        // $acRpt = new AccountReport(12,14);
        // $this->assertEquals(1, $acRpt->savings(12,14));
    }
}
