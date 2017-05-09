<?php
declare(strict_types=1);

namespace AppTest\Repository;

use App\Repository\Account;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Mockery;

class AccountTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    public function setup()
    {
        $this->queryBuilderMock = Mockery::mock('\QueryBuilder');
        $this->queryBuilderMock->shouldReceive('execute')
            ->byDefault();

        $connectionMock = Mockery::mock('\Connection');
        $connectionMock->shouldReceive('createQueryBuilder')
            ->andReturn($this->queryBuilderMock);

        $this->repository = new Account($connectionMock);
    }

    /**
     * @test
     */
    public function inserting()
    {
        $account = [
            'id' => 1,
            'title' => 'Cash',
            'type' => 'expense',
        ];

        $this->queryBuilderMock->shouldReceive('insert')
            ->once()
            ->with('account')
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('values')
            ->once()
            ->with([
                'account_id' => 1,
                'title' => 'Cash',
                'type' => 'expense',
            ])
            ->andReturnSelf();

        $this->repository->insert($account);
    }

    /**
     * @test
     */
    public function updating()
    {
        $accountId = 1;
        $balance = [
            'amount' => 100,
            'currency' => 'EUR',
        ];

        $this->queryBuilderMock->shouldReceive('insert')
            ->once()
            ->with('balance')
            ->andReturnSelf();

        $this->queryBuilderMock->shouldReceive('values')
            ->once()
            ->with([
                'account_id' => 1,
                'amount' => 100,
                'currency' => 'EUR',
            ])
            ->andReturnSelf();

        $this->repository->update($accountId, $balance);
    }
}
