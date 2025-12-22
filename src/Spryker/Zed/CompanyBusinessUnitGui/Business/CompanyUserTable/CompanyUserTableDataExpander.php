<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitGui\Business\CompanyUserTable;

use Spryker\Zed\CompanyBusinessUnitGui\Communication\Plugin\CompanyUserGui\CompanyBusinessUnitCompanyUserTableConfigExpanderPlugin;
use Spryker\Zed\CompanyBusinessUnitGui\CompanyBusinessUnitGuiConfig;
use Spryker\Zed\CompanyBusinessUnitGui\Dependency\Facade\CompanyBusinessUnitGuiToCompanyBusinessUnitFacadeInterface;

class CompanyUserTableDataExpander implements CompanyUserTableDataExpanderInterface
{
    public function __construct(protected CompanyBusinessUnitGuiToCompanyBusinessUnitFacadeInterface $companyBusinessUnitFacade)
    {
    }

    /**
     * @param list<array<string, mixed>> $companyUserDataTableRows
     *
     * @return list<array<string, mixed>>
     */
    public function expandCompanyUserTableDataWithBusinessUnitNames(array $companyUserDataTableRows): array
    {
        $companyUserIds = $this->extractCompanyUserIds($companyUserDataTableRows);
        $companyBusinessUnitNameMap = $this->companyBusinessUnitFacade->getCompanyBusinessUnitNamesIndexedByCompanyUserIds($companyUserIds);

        foreach ($companyUserDataTableRows as $index => $companyUserDataTableRow) {
            $idCompanyUser = $companyUserDataTableRow[CompanyBusinessUnitGuiConfig::COL_ID_COMPANY_USER];
            $companyBusinessUnitName = $companyBusinessUnitNameMap[$idCompanyUser] ?? null;

            $companyUserDataTableRows[$index][CompanyBusinessUnitCompanyUserTableConfigExpanderPlugin::COL_COMPANY_BUSINESS_UNIT_NAME] = $companyBusinessUnitName;
        }

        return $companyUserDataTableRows;
    }

    /**
     * @param list<array<string, mixed>> $companyUserDataTableRows
     *
     * @return list<int>
     */
    protected function extractCompanyUserIds(array $companyUserDataTableRows): array
    {
        $companyUserIds = [];

        foreach ($companyUserDataTableRows as $companyUserDataTableRow) {
            if (isset($companyUserDataTableRow[CompanyBusinessUnitGuiConfig::COL_ID_COMPANY_USER])) {
                $companyUserIds[] = $companyUserDataTableRow[CompanyBusinessUnitGuiConfig::COL_ID_COMPANY_USER];
            }
        }

        return $companyUserIds;
    }
}
