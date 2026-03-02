<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitGui\Dependency\Facade;

use Generated\Shared\Transfer\CompanyBusinessUnitCollectionTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitCriteriaFilterTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitResponseTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class CompanyBusinessUnitGuiToCompanyBusinessUnitFacadeBridge implements CompanyBusinessUnitGuiToCompanyBusinessUnitFacadeInterface
{
    /**
     * @var \Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface
     */
    protected $companyBusinessUnitFacade;

    /**
     * @param \Spryker\Zed\CompanyBusinessUnit\Business\CompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade
     */
    public function __construct($companyBusinessUnitFacade)
    {
        $this->companyBusinessUnitFacade = $companyBusinessUnitFacade;
    }

    public function getCompanyBusinessUnitById(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyBusinessUnitTransfer {
        return $this->companyBusinessUnitFacade->getCompanyBusinessUnitById($companyBusinessUnitTransfer);
    }

    public function update(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyBusinessUnitResponseTransfer {
        return $this->companyBusinessUnitFacade->update($companyBusinessUnitTransfer);
    }

    public function create(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyBusinessUnitResponseTransfer {
        return $this->companyBusinessUnitFacade->create($companyBusinessUnitTransfer);
    }

    public function delete(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyBusinessUnitResponseTransfer {
        return $this->companyBusinessUnitFacade->delete($companyBusinessUnitTransfer);
    }

    public function getCompanyBusinessUnitCollection(
        CompanyBusinessUnitCriteriaFilterTransfer $companyBusinessUnitCriteriaFilterTransfer
    ): CompanyBusinessUnitCollectionTransfer {
        return $this->companyBusinessUnitFacade
            ->getCompanyBusinessUnitCollection($companyBusinessUnitCriteriaFilterTransfer);
    }

    public function findCompanyBusinessUnitById(int $idCompanyBusinessUnit): ?CompanyBusinessUnitTransfer
    {
        return $this->companyBusinessUnitFacade->findCompanyBusinessUnitById($idCompanyBusinessUnit);
    }

    /**
     * @param list<int> $companyUserIds
     *
     * @return array<int, string>
     */
    public function getCompanyBusinessUnitNamesIndexedByCompanyUserIds(array $companyUserIds): array
    {
        return $this->companyBusinessUnitFacade->getCompanyBusinessUnitNamesIndexedByCompanyUserIds($companyUserIds);
    }
}
