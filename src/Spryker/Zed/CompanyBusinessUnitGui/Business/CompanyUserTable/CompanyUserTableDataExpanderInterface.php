<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitGui\Business\CompanyUserTable;

interface CompanyUserTableDataExpanderInterface
{
    /**
     * @param list<array<string, mixed>> $companyUserDataTableRows
     *
     * @return list<array<string, mixed>>
     */
    public function expandCompanyUserTableDataWithBusinessUnitNames(array $companyUserDataTableRows): array;
}
