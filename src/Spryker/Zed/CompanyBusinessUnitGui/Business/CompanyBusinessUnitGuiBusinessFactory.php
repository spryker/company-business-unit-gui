<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitGui\Business;

use Spryker\Zed\CompanyBusinessUnitGui\Business\CompanyBusinessUnit\CompanyBusinessUnitGuiReader;
use Spryker\Zed\CompanyBusinessUnitGui\Business\CompanyBusinessUnit\CompanyBusinessUnitGuiReaderInterface;
use Spryker\Zed\CompanyBusinessUnitGui\Business\CompanyUserTable\CompanyUserTableDataExpander;
use Spryker\Zed\CompanyBusinessUnitGui\Business\CompanyUserTable\CompanyUserTableDataExpanderInterface;
use Spryker\Zed\CompanyBusinessUnitGui\CompanyBusinessUnitGuiDependencyProvider;
use Spryker\Zed\CompanyBusinessUnitGui\Dependency\Facade\CompanyBusinessUnitGuiToCompanyBusinessUnitFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Spryker\Zed\CompanyBusinessUnitGui\CompanyBusinessUnitGuiConfig getConfig()
 */
class CompanyBusinessUnitGuiBusinessFactory extends AbstractBusinessFactory
{
    public function createCompanyBusinessUnitGuiReader(): CompanyBusinessUnitGuiReaderInterface
    {
        return new CompanyBusinessUnitGuiReader(
            $this->getCompanyBusinessUnitFacade(),
        );
    }

    public function createCompanyUserTableDataExpander(): CompanyUserTableDataExpanderInterface
    {
        return new CompanyUserTableDataExpander($this->getCompanyBusinessUnitFacade());
    }

    public function getCompanyBusinessUnitFacade(): CompanyBusinessUnitGuiToCompanyBusinessUnitFacadeInterface
    {
        return $this->getProvidedDependency(CompanyBusinessUnitGuiDependencyProvider::FACADE_COMPANY_BUSINESS_UNIT);
    }
}
