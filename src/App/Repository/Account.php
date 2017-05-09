<?php
declare(strict_types=1);

namespace App\Repository;

class Account
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(\Connection $connection)
    {
        $this->connection = $connection;
    }

    protected function getConnection()
    {
        return $this->connection;
    }

    protected function getQueryBuilder() : \QueryBuilder
    {
        return $this->getConnection()->createQueryBuilder();
    }

    public function insert($account)
    {
        $qb = $this->getQueryBuilder();

        $qb->insert('account')
            ->values(
                [
                    'account_id' => $account['id'],
                    'title' => $account['title'],
                    'type' => $account['type'],
                ]
            )
            ->execute();
    }

    public function update($accountId, $balance)
    {
        $qb = $this->getQueryBuilder();

        $qb->insert('balance')
            ->values(
                [
                    'account_id' => $accountId,
                    'amount' => $balance['amount'],
                    'currency' => $balance['currency'],
                ]
            )
            ->execute();
    }
}
