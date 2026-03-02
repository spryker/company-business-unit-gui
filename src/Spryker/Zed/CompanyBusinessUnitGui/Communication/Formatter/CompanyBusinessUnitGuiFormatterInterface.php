<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitGui\Communication\Formatter;

use Generated\Shared\Transfer\CompanyBusinessUnitCollectionTransfer;

interface CompanyBusinessUnitGuiFormatterInterface
{
    public function formatCompanyBusinessUnitCollectionToSuggestions(CompanyBusinessUnitCollectionTransfer $companyBusinessUnitCollectionTransfer): array;
}
