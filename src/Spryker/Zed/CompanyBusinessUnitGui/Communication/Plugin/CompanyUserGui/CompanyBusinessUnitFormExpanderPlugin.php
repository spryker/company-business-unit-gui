<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyBusinessUnitGui\Communication\Plugin\CompanyUserGui;

use Spryker\Zed\CompanyUserGuiExtension\Dependency\Plugin\CompanyUserFormExpanderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @deprecated Use {@link \Spryker\Zed\CompanyBusinessUnitGui\Communication\Plugin\CompanyUserGui\CompanyBusinessUnitToCompanyUserFormExpanderPlugin} instead.
 *
 * @method \Spryker\Zed\CompanyBusinessUnitGui\Communication\CompanyBusinessUnitGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\CompanyBusinessUnitGui\Business\CompanyBusinessUnitGuiFacadeInterface getFacade()
 * @method \Spryker\Zed\CompanyBusinessUnitGui\CompanyBusinessUnitGuiConfig getConfig()
 */
class CompanyBusinessUnitFormExpanderPlugin extends AbstractPlugin implements CompanyUserFormExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     * - Expands Company User form with CompanyBusinessUnit subform.
     *
     * @api
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return \Symfony\Component\Form\FormBuilderInterface
     */
    public function expand(FormBuilderInterface $builder): FormBuilderInterface
    {
        $formType = $this->getFactory()
            ->createCompanyUserBusinessUnitForm();

        $dataProvider = $this->getFactory()
            ->createCompanyUserBusinessUnitFormDataProvider();

        $idCompanyBusinessUnit = $builder->getData()->getFkCompanyBusinessUnit();

        $formType->buildForm(
            $builder,
            $dataProvider->getOptions($idCompanyBusinessUnit),
        );

        return $builder;
    }
}
