<?php

declare(strict_types=1);

namespace Core\Model;

use Hyperf\Database\Model\SoftDeletes;
/**
 * @property int $id 自增ID
 * @property string $code 药品编码
 * @property string $name 药品名称
 * @property string $format 药品规格
 * @property int $isBase 基药标识 0否 1是
 * @property string $batchNo 药品批号
 * @property string $expirationDate 有效期
 * @property int $stock 库存
 * @property string $price 药品进价
 * @property string $retailPrice 药品零售价
 * @property string $unit 包装单位
 * @property string $manufacturer 生产厂家
 * @property int $dosageId 药品剂型
 * @property int $typeId 药品类型
 * @property string $mnemonicCode 拼音助记码
 * @property string $genericName 通用名
 * @property int $status 状态
 * @property string $store 存放位置
 * @property \Carbon\Carbon $createdAt 创建时间
 * @property \Carbon\Carbon $updatedAt 修改时间
 * @property string $deletedAt 删除时间 ( 软删除 )
 */
class PmsDrug extends AbstractModel
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'pms_drug';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'code', 'name', 'format', 'is_base', 'batch_no', 'expiration date', 'stock', 'price', 'retail_price', 'unit', 'manufacturer', 'dosage_id', 'type_id', 'mnemonic_code', 'generic_name', 'status', 'store', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'is_base' => 'integer', 'stock' => 'integer', 'price' => 'decimal:2', 'retail_price' => 'decimal:2', 'dosage_id' => 'integer', 'type_id' => 'integer', 'status' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}
