<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-22 15:55:38
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-22 16:03:16
 * @FilePath: \join-his\join-his\core\Model\PmsDrugManufacturer.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

declare(strict_types=1);

namespace Core\Model;



/**
 * @property int $id ID
 * @property string $name 名称
 * @property string $code 编码
 * @property string $contactName 联系人姓名
 * @property string $contactPhone 联系电话
 * @property string $contactAddr 联系地址
 * @property int $postCode 邮编
 * @property int $isSupplier 是否是供应商
 * @property int $isManufacturer 是否是生产商
 */
class PmsDrugManufacturer extends AbstractModel
{
    
    
    public bool $timestamps = false;
    /**
     * The table associated with the model.
     */
    protected ?string $table = 'pms_drug_manufacturers';

    /**
     * The attributes that are mass assignable.
     */
    protected array $fillable = ['id', 'name', 'code', 'contact_name', 'contact_phone', 'contact_addr', 'post_code', 'is_supplier', 'is_manufacturer'];

    /**
     * The attributes that should be cast to native types.
     */
    protected array $casts = ['id' => 'integer', 'post_code' => 'integer', 'is_supplier' => 'integer', 'is_manufacturer' => 'integer'];
}
