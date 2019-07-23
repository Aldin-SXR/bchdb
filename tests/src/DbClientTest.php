<?php
use PHPUnit\Framework\TestCase;
use BCHDB\Client\DbClient;

require_once __DIR__.'/../../autoload.php';

/**
 * DbClient tests.
 */

class DbClientTest extends TestCase {
    /** @var DbClient $db Database client. */
    private static $db;

    public function testSuccessfullyCreatesAClient() {
        self::$db = new DbClient();
        $this->assertInstanceOf(DbClient::class, self::$db);
    }

    public function testCorrectlyCreatesCollectionIndices() {
        $idx_data = self::$db->collection('test')->index([
            [ 'a' => 1 ], [ 'b' => -1 ]
        ]);

        $this->assertEquals('a_1', $idx_data[0]);
        $this->assertEquals('b_-1', $idx_data[1]);
    }

    public function testCorrectlyInsertsANewRecord() {
        $insert_data = self::$db->collection('test')->upsert('test_id', [
            'a' => 'Hello, world.',
            'b' => 42
        ]);

        $this->assertEquals('test_id', $insert_data->getUpsertedId());
        $this->assertEquals(1, $insert_data->getUpsertedCount());
    }

    public function testCorrectlyUpdatesAnExistingRecord() {
        $insert_data = self::$db->collection('test')->upsert('test_id', [
            'a' => 'Hello, world.',
            'b' => 14.53
        ]);

        $this->assertEquals(1, $insert_data->getMatchedCount());
        $this->assertEquals(1, $insert_data->getModifiedCount());
    }

    public static function tearDownAfterClass(): void {
        self::$db->collection('test')->drop();
    }
}