<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitGui\Communication\Formatter;

use Generated\Shared\Transfer\CompanyBusinessUnitCollectionTransfer;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Spryker\Zed\CompanyBusinessUnitGui\Communication\Generator\CompanyBusinessUnitNameGeneratorInterface;

class CompanyBusinessUnitGuiFormatter implements CompanyBusinessUnitGuiFormatterInterface
{
    /**
     * @var string
     */
    protected const KEY_ID = 'id';

    /**
     * @var string
     */
    protected const KEY_TEXT = 'text';

    /**
     * @var \Spryker\Zed\CompanyBusinessUnitGui\Communication\Generator\CompanyBusinessUnitNameGeneratorInterface
     */
    protected $companyBusinessUnitNameGenerator;

    public function __construct(CompanyBusinessUnitNameGeneratorInterface $generator)
    {
        $this->companyBusinessUnitNameGenerator = $generator;
    }

    public function formatCompanyBusinessUnitCollectionToSuggestions(CompanyBusinessUnitCollectionTransfer $companyBusinessUnitCollectionTransfer): array
    {
        $formattedSuggestCompanyBusinessUnits = [];

        foreach ($companyBusinessUnitCollectionTransfer->getCompanyBusinessUnits() as $companyBusinessUnitTransfer) {
            $formattedSuggestCompanyBusinessUnits[] = [
                static::KEY_ID => $companyBusinessUnitTransfer->getIdCompanyBusinessUnit(),
                static::KEY_TEXT => $this->generateCompanyBusinessUnitName($companyBusinessUnitTransfer),
            ];
        }

        return $formattedSuggestCompanyBusinessUnits;
    }

    protected function generateCompanyBusinessUnitName(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): string
    {
        return $this->companyBusinessUnitNameGenerator->generateName($companyBusinessUnitTransfer);
    }
}
