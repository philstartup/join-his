<?php

declare(strict_types=1);

namespace Core\Model;



/**
 * @property int $id 自增 ID
 * @property int $type 树状字典类型 0，1患者类型 2 药品类型 3 药品剂型
 * @property string $name 类型名称
 * @property int $status 状态
 * @property \Carbon\Carbon $createdAt 创建时间
 */
class PmsDict extends AbstractModel
{
    public bool $timestamps = false;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'pms_dict';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'type', 'name', 'status', 'created_at'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'type' => 'integer', 'status' => 'integer', 'created_at' => 'datetime'];
}
