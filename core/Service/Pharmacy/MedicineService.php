<?php
/*
 * @Author: luyongqiang phillu@outlook.com
 * @Date: 2024-04-18 10:16:56
 * @LastEditors: luyongqiang phillu@outlook.com
 * @LastEditTime: 2024-04-19 17:55:45
 * @FilePath: \join-his\join-his\core\Service\Pharmacy\MedicineService.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */

namespace Core\Service\Pharmacy;

use Core\Exception\BusinessException;
use Core\Model\PmsDrug;
use Core\Repository\PmsDrugRepository;
use Core\Service\AbstractService;
use Hyperf\Contract\PaginatorInterface;
use Hyperf\Di\Annotation\Inject;
use Kernel\Exception\NotFoundException;

class MedicineService extends AbstractService
{
    #[Inject]
    protected PmsDrugRepository $repo;

    /**
     * 获取药品列表
     * @param array $searchParams 搜索参数
     * @return PaginatorInterface
     */
    public function search(array $searchParams = []): PaginatorInterface
    {
        $query = $this->repo->getQuery()->orderByDesc('id');

        return $this->repo->search($searchParams, $query);
    }

    /**
     * 取药
     * @param int $patientId 患者ID
     * @param int $prescriptionId 处方ID
     * @return PmsDrug
     */
    public function takeDrug(int $patientId, int $prescriptionId)
    {
        $prescription = Prescription::find($prescriptionId);
        if (!$prescription) {
            throw new \Exception('Prescription not found');
        }

        $drug = $this->repo->getById($prescription->drug_id); 
        if (!$drug) {
            throw new \Exception('Drug not found');
        }

        if ($drug->stock > 0) {
            // 取药操作
            $drug->stock -= 1;
            $drug->save();
            // 记录取药信息
        } else {
            // 退药操作
            $drug->stock += 1;
            $drug->save();
            // 记录退药信息
        }
    }


    /**
     * 获取药品库存
     * @param int $drugId 药品ID
     * @return int
     */
    public function getDrugStock(int $drugId): int
    {
        $drug = $this->repo->getById($drugId);
        if (!$drug) {
            throw new \Exception('Drug not found');
        }

        return $drug->stock;
    }

    /**
     * 获取药品库存
     * @param string $drugName 药品名称
     * @return int
     */
    public function getDrugStockByName(string $drugName): int
    {
        $drug = $this->repo->getByName($drugName);
        if (!$drug) {
            throw new \Exception('Drug not found');
        }

        return $drug->stock;
    }

    





    /**
     * 退药
     * @param int $patientId 患者ID
     * @param int $prescriptionId 处方ID
     * @return PmsDrug
     */
    public function returnDrug(int $patientId, int $prescriptionId)
    {
        $prescription = Prescription::find($prescriptionId);
        if (!$prescription) {
            throw new \Exception('Prescription not found');
        }

        $drug = $this->repo->getById($prescription->drug_id); 
        if (!$drug) {
            throw new \Exception('Drug not found');
        }

        // 退药操作
        $drug->stock += 1;
        $drug->save();
        // 记录退药信息
        if (!$drug) {
            throw new \Exception('Drug not found');
        }
        return $drug;
    }

}