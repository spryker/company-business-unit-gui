<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitGui\Communication\FormExpander;

use Symfony\Component\Form\FormBuilderInterface;

interface CompanyBusinessUnitToCompanyUserFormExpanderInterface
{
    public function expand(FormBuilderInterface $builder): FormBuilderInterface;
}
