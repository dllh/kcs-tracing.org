<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EnvironmentsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EnvironmentsTable Test Case
 */
class EnvironmentsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EnvironmentsTable
     */
    protected $Environments;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Environments',
        'app.Schools',
        'app.Reports',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Environments') ? [] : ['className' => EnvironmentsTable::class];
        $this->Environments = $this->getTableLocator()->get('Environments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Environments);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\EnvironmentsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\EnvironmentsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
