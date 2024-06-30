<?php

namespace App\Models\Repositories\PaymentChannel;

use App\Models\Entities\PaymentChannel;
use App\Models\Factories\PaymentChannelFactory;
use Illuminate\Support\Collection;
use Eghamat24\DatabaseRepository\Models\Repositories\MySqlRepository;

class MySqlPaymentChannelRepository extends MySqlRepository implements IPaymentChannelRepository
{
    public function __construct()
    {
        $this->table = 'payment_channels';
        $this->primaryKey = 'id';
        $this->softDelete = true;
        $this->factory = new PaymentChannelFactory();

        parent::__construct();
    }

    public function getOneById(int $id): null|PaymentChannel
    {
        $paymentChannel = $this->newQuery()
            ->where('id', $id)
            ->first();

        return $paymentChannel ? $this->factory->makeEntityFromStdClass($paymentChannel) : null;
    }

    public function getAll(?int $offset = 0, ?int $count = 0, int &$total = null): Collection
    {
        $paymentChannel = $this->newQuery()
            ->whereNull('deleted_at')
            ->get();

        return $this->factory->makeCollectionOfEntities($paymentChannel);
    }

    public function create(PaymentChannel $paymentChannel): PaymentChannel
    {
        $paymentChannel->setCreatedAt(date('Y-m-d H:i:s'));
        $paymentChannel->setUpdatedAt(date('Y-m-d H:i:s'));

        $id = $this->newQuery()
            ->insertGetId([
                'name' => $paymentChannel->getName(),
                'name_en' => $paymentChannel->getNameEn(),
                'class_name' => $paymentChannel->getClassName(),
                'url' => $paymentChannel->getUrl(),
                'is_active' => $paymentChannel->getIsActive(),
                'priority' => $paymentChannel->getPriority(),
                'supporter_name' => $paymentChannel->getSupporterName(),
                'supporter_phone' => $paymentChannel->getSupporterPhone(),
                'supporter_email' => $paymentChannel->getSupporterEmail(),
                'description' => $paymentChannel->getDescription(),
                'created_at' => $paymentChannel->getCreatedAt(),
                'updated_at' => $paymentChannel->getUpdatedAt(),
            ]);

        $paymentChannel->setId($id);

        return $paymentChannel;
    }

    public function update(PaymentChannel $paymentChannel): int
    {
        $paymentChannel->setUpdatedAt(date('Y-m-d H:i:s'));

        return $this->newQuery()
            ->where($this->primaryKey, $paymentChannel->getPrimaryKey())
            ->update([
                'name' => $paymentChannel->getName(),
                'name_en' => $paymentChannel->getNameEn(),
                'class_name' => $paymentChannel->getClassName(),
                'url' => $paymentChannel->getUrl(),
                'is_active' => $paymentChannel->getIsActive(),
                'priority' => $paymentChannel->getPriority(),
                'supporter_name' => $paymentChannel->getSupporterName(),
                'supporter_phone' => $paymentChannel->getSupporterPhone(),
                'supporter_email' => $paymentChannel->getSupporterEmail(),
                'description' => $paymentChannel->getDescription(),
                'updated_at' => $paymentChannel->getUpdatedAt(),
            ]);
    }
}
