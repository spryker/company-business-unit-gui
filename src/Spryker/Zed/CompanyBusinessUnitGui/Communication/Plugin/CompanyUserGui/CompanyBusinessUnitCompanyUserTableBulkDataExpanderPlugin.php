<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitGui\Communication\Plugin\CompanyUserGui;

use Spryker\Zed\CompanyUserGuiExtension\Dependency\Plugin\CompanyUserTableBulkDataExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\CompanyBusinessUnitGui\Business\CompanyBusinessUnitGuiBusinessFactory getBusinessFactory()
 * @method \Spryker\Zed\CompanyBusinessUnitGui\Communication\CompanyBusinessUnitGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\CompanyBusinessUnitGui\CompanyBusinessUnitGuiConfig getConfig()
 */
class CompanyBusinessUnitCompanyUserTableBulkDataExpanderPlugin extends AbstractPlugin implements CompanyUserTableBulkDataExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     * - Extends table data rows of company user table with company business unit names in bulk.
     * - Fetches all company business unit names for given company users at once to improve performance.
     *
     * @api
     *
     * @param list<array<string, mixed>> $companyUserDataTableRows
     *
     * @return list<array<string, mixed>>
     */
    public function expandData(array $companyUserDataTableRows): array
    {
        return $this->getBusinessFactory()
            ->createCompanyUserTableDataExpander()
            ->expandCompanyUserTableDataWithBusinessUnitNames($companyUserDataTableRows);
    }
}
